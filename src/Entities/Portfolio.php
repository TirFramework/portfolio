<?php

namespace Tir\Portfolio\Models;

use Tir\Crud\Models\CrudModel;

class Portfolio extends CrudModel
{

    use SoftDeletes, CascadeSoftDeletes;

    protected $guarded = ['id', 'categories', 'tags', 'save_close'];
    protected $hidden = ['pivot'];



    public function scopePublished($query)
    {
        return $query->where('published_at', '<', \Carbon\Carbon::now());
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'slugortitle'
            ]
        ];
    }


    public function getSlugortitleAttribute() {

        if($this->slug == null){
            return $this->title ;
        }
        return $this->slug;
    }

    protected $casts = [
        'images' => 'array',
        'meta_description' => 'array',
        'media' => 'array',
    ];

    public $timestamps = true;

    public function categories()
    {
        return $this->belongsToMany(Category::Class, 'category_post');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function user()
    {
        return $this->belongsTo(User::Class);
    }



    public function getFields()
    {
        $fields = [
            [
                'name'    => 'basic_information',
                'type'    => 'group',
                'visible' => 'ce',
                'tabs'    => [
                    [
                        'name'    => 'general',
                        'type'    => 'tab',
                        'visible' => 'ce',
                        'fields'  => [
                            [
                                'name'    => 'id',
                                'type'    => 'text',
                                'visible' => 'io',
                            ],
                            [
                                'name'       => 'title',
                                'type'       => 'text',
                                'validation' => 'required',
                                'visible'    => 'ice',
                            ],

                            [
                                'name'    => 'slug',
                                'type'    => 'text',
                                'visible' => 'ice',
                            ],

                            [
                                'name'    => 'image',
                                'type'    => 'image',
                                'visible' => 'ce',
                            ],
                            [
                                'name'       => 'alt',
                                'type'       => 'text',
                                'validation' => 'required',
                                'visible'    => 'ice',
                            ],


                            [
                                'name'     => 'categories',
                                'type'     => 'relationM',
                                'relation' => ['categories', 'name'],
                                'visible'  => 'ice',
                            ],

                            [
                                'name'      => "ordered",
                                'type'      => 'order',
                                'visible'   => 'ice'
                            ],

                            [
                                'name'      => "summary",
                                'type'      => 'textarea',
                                'visible'   => 'ce'
                            ],

                            [
                                'name'       => 'description',
                                'type'       => 'textEditor',
                                'validation' => 'required',
                                'col'        => 'col-md-12',
                                'visible'    => 'ce',
                            ],

                            [
                                'name'      => 'top',
                                'type'      => 'select',
                                'data'      => [false => trans('panel.no'), true => trans('panel.yes')],
                                'visible'   => 'ce'
                            ],

                            [
                                'name'      => 'status',
                                'type'      => 'status',
                                'visible'   => 'icef'
                            ]

                        ]
                    ],
                ]
            ]

        ];


        return json_decode(json_encode($fields));

    }
}
