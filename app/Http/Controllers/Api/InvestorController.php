<?php

namespace App\Http\Controllers\Api;

use App\Entities\Investor;
use App\Entities\Project;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveInvestorRequest;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class InvestorController extends Controller
{
    public function autocompleteFieldSearchInvestors(Request $request)
    {
        $keyword = $request->get('keyword');
        if (empty($keyword)) {
            return response()->json([]);
        }

        $investors = Investor::query()
            ->where('name', 'like', "%$keyword%")
            ->select([DB::raw('id as value'), 'name'])
            ->limit(10)->get();

        return response()->json($investors);
    }

    public function create(SaveInvestorRequest $request)
    {
        $validatedData = $request->validated();
        $user = auth()->user();

        try {
            DB::beginTransaction();

            // Create investor
            /** @var Investor $createdInvestor */
            $createdInvestor = Investor::query()->create([
                'name' => $validatedData['name'],
                'phone' => $validatedData['phone'],
                'email' => $validatedData['email'],
                'website' => $validatedData['website'],
                'overview' => $validatedData['overview'],
                'user_id' => $user->id,
            ]);

            // Store logo
            if (!empty($validatedData['logo'])) {
                $this->uploadInvestorLogo($createdInvestor, $validatedData['logo']);
            }

            // Save address
            if ($validatedData['address']) {
                $createdInvestor->address()->create($validatedData['address']);
            }

            DB::commit();

            return response()->noContent();
        } catch (\Exception $exception) {
            DB::rollBack();
        }

        return response()->json(['message' => 'Đã có lỗi xảy ra khi lưu chủ đầu tư vui lòng thử lại'], 500);
    }

    public function update($investorId, SaveInvestorRequest $request)
    {
        $validatedData = $request->validated();
        $user = auth()->user();

        /** @var Investor $investor */
        $investor = Investor::query()
            ->where('id', '=', $investorId)
            ->where('user_id', '=', $user->id)
            ->first();
        if (!$investor) {
            return response()->json(['message' => 'Thông tin chủ đầu tư bạn yêu cầu không tồn tại'], 400);
        }

        try {
            DB::beginTransaction();

            // Create investor
            $investor->update([
                'name' => $validatedData['name'],
                'phone' => $validatedData['phone'],
                'email' => $validatedData['email'],
                'website' => $validatedData['website'],
                'overview' => $validatedData['overview'],
            ]);

            // Store logo
            if (!empty($validatedData['logo'])) {
                $this->uploadInvestorLogo($investor, $validatedData['logo']);
            }

            // Save address
            if ($validatedData['address']) {
                $investor->address()->updateOrCreate([], $validatedData['address']);
            }

            DB::commit();

            return response()->noContent();
        } catch (\Exception $exception) {
            DB::rollBack();
        }

        return response()->json(['message' => 'Đã có lỗi xảy ra khi lưu chủ đầu tư vui lòng thử lại'], 500);
    }

    private function uploadInvestorLogo(Investor $investor, UploadedFile $logo)
    {
        $fileName = $investor->id . "." . $logo->extension();
        $savedPath = $logo->storeAs('/public/uploads/investor/logo', $fileName, ['visibility' => 'public']);
        $investor->logo = str_replace('public', '', $savedPath);
        $investor->save();
    }
}
