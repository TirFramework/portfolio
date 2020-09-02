<?php

namespace Tir\Portfolio\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Auth;
use Tir\Crud\Support\Eloquent\CrudModel;
use Tir\Crud\Support\Eloquent\Translatable;
use Tir\Store\Category\Entities\Category;
use Tir\User\Entities\User;

class Portfolio extends CrudModel
{

    use Translatable, Sluggable;

    /**
     * The attribute show route name
     * and we use in fieldTypes and controllers
     *
     * @var string
     */
    public static $routeName = 'portfolio';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['slug', 'status','user_id', 'author_id','images','gallery'];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = ['title', 'content','summary'];


    protected $casts = [
        'images' => 'array',
        'gallery' => 'array'
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'slug'
            ]
        ];
    }

    /**
     * This function return array for validation
     *
     * @return array
     */
    public function getValidation()
    {
        return [
            'title'   => 'required',
            'slug'    => 'required',
            'status'  => 'required',
        ];
    }


    /**
     * This function return an object of field
     * and we use this for generate admin panel page
     * @return array
     */
    public function getFields()
    {
        return [
            [
                'name'    => 'basic_information',
                'type'    => 'group',
                'visible' => 'ce',
                'tabs'    => [
                    [
                        'name'    => 'portfolio_information',
                        'type'    => 'tab',
                        'visible' => 'ce',
                        'fields'  => [
                            [
                                'name'    => 'id',
                                'type'    => 'text',
                                'visible' => 'io',
                            ],
                            [
                                'name'    => 'title',
                                'type'    => 'text',
                                'validation' => 'required',
                                'visible' => 'ice',
                            ],
                            [
                                'name'    => 'author_id',
                                'type'    => 'relation',
                                'relation' => ['author', 'name'],
                                'visible' => 'ice',
                            ],
                            [
                                'name'    => 'slug',
                                'type'    => 'text',
                                'visible' => 'ce',
                            ],
                            [
                                'name' => 'categories',
                                'type' => 'relationM',
                                'relation' => ['categories', 'name'],
                                'visible' => 'ice'
                            ],
                            [
                                'name'    => 'summary',
                                'type'    => 'textarea',
                                'visible' => 'ce',
                            ],
                            [
                                'name'    => 'content',
                                'type'    => 'textEditor',
                                'visible' => 'ce',
                            ],
                            // [
                            //     'name'    => 'created_at',
                            //     'type'    => 'text',
                            //     'visible' => 'c',
                            // ],
                            [
                                'name'    => 'status',
                                'type'    => 'select',
                                'data'    => ['draft'       => trans('portfolio::panel.draft'),
                                              'published'   => trans('portfolio::panel.published'),
                                              'unpublished' => trans('portfolio::panel.unpublished')
                                ],
                                'visible' => 'icef',
                            ],
                        ]
                    ],
                    [
                        'name'    => 'images',
                        'type'    => 'tab',
                        'visible' => 'ice',
                        'fields'  => [
                            [
                                'name'    => 'images[intro]',
                                'display' => 'intro_image',
                                'type'    => 'image',
                                'visible' => 'ce',
                            ],
                            [
                                'name'    => 'images[main]',
                                'display' => 'intro_image',
                                'type'    => 'image',
                                'visible' => 'ce',
                            ],
                            [
                                'name'    => 'gallery',
                                'display' => 'gallery',
                                'type'    => 'images',
                                'visible' => 'ce'
                            ]
                        ]
                    ],

                    [
                        'name'    => 'meta',
                        'type'    => 'tab',
                        'visible' => 'ce',
                        'fields'  => [
                            [
                                'name'    => 'meta[keyword]',
                                'display' => 'meta_keywords',
                                'type'    => 'text',
                                'visible' => 'ce',
                            ],
                            [
                                'name'    => 'meta[description]',
                                'display' => 'meta_description',
                                'type'    => 'textarea',
                                'visible' => 'ce',
                            ]
                        ]
                    ]


                ]
            ]
        ];
    }

    //

    public function getPublishedAtAttribute($value)
    {
        if( config('app.locale') =='fa' ){
            return jdate($value)->format('%H:%M %A %d %B %Y');
        }
    }

    //Additional methods //////////////////////////////////////////////////////////////////////////////////////////////


    //Relations methods ///////////////////////////////////////////////////////////////////////////////////////////////

    public function categories()
    {
        return $this->belongsToMany(PortfolioCategory::class);
    }

    public function author(){
        return $this->belongsTo(User::class, 'author_id');
    }
}
