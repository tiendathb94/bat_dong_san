<?php

namespace App\Http\Controllers\Api;

use App\Entities\Investor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

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
}
