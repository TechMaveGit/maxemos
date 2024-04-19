<?php

namespace App\Http\Controllers;

use App\Models\CareerPost;
use Illuminate\Http\Request;
use Auth;
use DB;

class CommonController extends Controller
{

    public function index(){
        $careerPosts = CareerPost::orderBy('opening_date','DESC')->get();
        return view('pages.carrers.list',compact('careerPosts'));
    }


}