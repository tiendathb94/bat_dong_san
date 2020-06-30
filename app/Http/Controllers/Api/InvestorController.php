<?php

namespace App\Http\Controllers\Api;

use App\Entities\Investor;
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
            if ($validatedData['logo']) {
                /** @var UploadedFile $logo */
                $logo = $validatedData['logo'];
                $fileName = $createdInvestor->id . "." . $logo->extension();
                $savedPath = $logo->storeAs('/public/uploads/investor/logo', $fileName, ['visibility' => 'public']);
                $createdInvestor->logo = str_replace('public', '', $savedPath);
                $createdInvestor->save();
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
}
