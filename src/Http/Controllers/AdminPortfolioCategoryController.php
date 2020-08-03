<?php

namespace Tir\Portfolio\Http\Controllers;

use Tir\Portfolio\Entities\PortfolioCategory;
use Tir\Crud\Controllers\CrudController;

class AdminPortfolioCategoryController extends CrudController
{
    protected $model = PortfolioCategory::Class;
}
