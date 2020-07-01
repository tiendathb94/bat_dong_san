<?php

namespace App\Http\Controllers\Web;

use App\Entities\Investor;
use App\Http\Controllers\Controller;

class InvestorController extends Controller
{
    public function create()
    {
        return view($this->_config['view']);
    }

    public function update($investorId)
    {
        $user = auth()->user();

        $investor = Investor::query()
            ->with('address')
            ->where('user_id', '=', $user->id)
            ->where('id', '=', $investorId)
            ->first();

        if (!$investor) {
            return abort(404);
        }

        return view($this->_config['view'], ['investor' => $investor]);
    }
}
