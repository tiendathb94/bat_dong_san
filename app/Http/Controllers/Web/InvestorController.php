<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class InvestorController extends Controller
{
    public function create()
    {
        return view($this->_config['view']);
    }
}
