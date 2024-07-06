<?php

namespace App\Classes;

use App\Models\Blog;

class GetBlogs{

    private $blogs;

    public function __construct($numberBlogs = 0)
    {

        $blogsQuery = Blog::query();

        if($numberBlogs > 0){

            $blogsQuery->take($numberBlogs);
        }

        $blogs = $blogsQuery->orderBy('updated_at','desc')->paginate(8);;

        $this->blogs = $blogs;
    }


    public function getBlogs()
    {
        return $this->blogs;
    }
}
