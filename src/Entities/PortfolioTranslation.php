<?php

namespace Tir\Portfolio\Entities;

use Tir\Crud\Support\Eloquent\TranslationModel;


class PortfolioTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title','summary','content','meta'];

    protected $casts = [
        'meta' => 'array'
    ];

}
