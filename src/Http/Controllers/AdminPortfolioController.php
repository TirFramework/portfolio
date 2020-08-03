<?php

namespace Tir\Portfolio\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tir\Portfolio\Entities\Portfolio;
use Tir\Crud\Controllers\CrudController;

class AdminPortfolioController extends CrudController
{
    protected $model = Portfolio::Class;

    public function storeRequestManipulation(Request $request)
    {
        if(empty($request->author_id)){
            $request->merge(['author_id' => Auth::id()]);
        }

        return $request;
    }

}
