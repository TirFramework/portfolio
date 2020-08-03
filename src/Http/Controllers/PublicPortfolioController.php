<?php

namespace Tir\Portfolio\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tir\Portfolio\Entities\Portfolio;
use Tir\Portfolio\Entities\PortfolioCategory;

use Illuminate\Routing\Controller;

class PublicPortfolioController extends Controller
{
    
    // TODO : Add scope status
    public function postDetails($slug)
    {

        // return $slug;

        // $post = Portfolio::where( 'slug', 'تست' )->firstOrFail();
        $post = Portfolio::where( 'slug', $slug )->with('author')->with('categories')->firstOrFail();
        // $post = Portfolio::all();
        
        
        $previous = Portfolio::where('id', '<', $post->id)->orderBy('id','desc')->first();
        $next = Portfolio::where('id', '>', $post->id)->orderBy('id')->first();
        
        // return $post->categories()->firstOrFail()->posts()->get();

        //  return $post->categories()->get()->pluck('id');
        
        $relatedPortfolios = Portfolio::whereIn('id', $post->categories()->get()->pluck('id'))->where('id','!=',$post->id)->get();
        
        // return $relatedPortfolios;

        $lastposts = Portfolio::latest()->limit(5)->get();


        $categories = PortfolioCategory::limit(10)/*->with('children')*/->withCount('posts')->get();


        // return $categories;



        return view(config('crud.front-template').'::public.portfolio.postDetailes', compact('post','previous','next', 'relatedPortfolios' ,'lastposts' ,'categories'));


    }


    public function category($slug)
    {
        
        
        $category = PortfolioCategory::where( 'slug', $slug )->firstOrFail();

        $posts = $category->posts()->with('author')->with('categories')->paginate(15);


        $lastposts = Portfolio::latest()->limit(5)->get();


        $categories = PortfolioCategory::limit(10)/*->with('children')*/->withCount('posts')->get();

        // return $posts;

        return view(config('crud.front-template').'::public.portfolio.category', compact('posts','lastposts','categories','category'));

    }


}
