<?php

namespace Tir\Profile\Http\Controllers;


use Tir\Portfolio\Entities\Portfolio;
use Tir\Crud\Http\Controllers\CrudController;

class AdminPortfolioController extends CrudController
{
    protected $model = Portfolio::Class;

}
