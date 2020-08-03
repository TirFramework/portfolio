<?php

namespace Tir\Portfolio\Entities;

use Tir\Crud\Support\Eloquent\TranslationModel;


class PortfolioCategoryTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','summary','description','meta'];

    public $table = 'portfolio_category_translations';

    protected $casts = [
        'meta' => 'array'
    ];

}
