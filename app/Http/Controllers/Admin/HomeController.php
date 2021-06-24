<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
       //$users = User::orderBy('created_at', 'desc')->limit(8)->get(); 
       //$users = User::orderBy('created_at', 'desc')->limit(8)->get();
       $users = User::orderBy('created_at', 'desc')->whereHas("roles", function($q) {
            $q->where("name", "user");
       })->get();

       $courses = Course::orderBy('created_at', 'desc')->limit(4)->get();
       //$users = User::orderBy('created_at', 'desc')->get();

       return view('admin.home.index', compact('users', 'courses'));
    }
}
