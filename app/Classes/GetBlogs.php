<?php

namespace App\Classes;

use App\Models\Blog;

class GetBlogs{

    private $blogs;

    public function __construct($numberBlogs = 0)
    {


        $blogsQuery = Blog::query();

        if($numberBlogs > 0){

            $blogs = $blogsQuery->take($numberBlogs)->orderBy('updated_at','desc')->get();
        } else {

            $blogs = $blogsQuery->orderBy('updated_at','desc')->paginate(8);
        }


        $this->blogs = $blogs;
    }


    public function getBlogs()
    {
        return $this->blogs;
    }
}
