<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\Subscribe;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;

use Mail;


class CourseController extends Controller
{
    public function index() {
        $courses = Course::orderBy('created_at', 'desc')->with('users')->get();
        return view('courses', compact('courses'));
    }

    public function mycourses() {
        $courses = Course::orderBy('created_at', 'desc')->get();
        return view('my-courses', compact('courses'));
    }
    public function course($slug) {
        
        $course = Course::where('slug', $slug)->first();

        if( isset($course->id) ) {       
            

            $showCourse = Subscribe::orderBy('created_at', 'asc')->where('course_id', $course->id)->where('user_id', Auth::id())->first();

            if( isset($showCourse) && $showCourse->id > 0) {
                //Note try with model function
                $lessons = Lesson::orderBy('created_at', 'asc')->where('course_id', $course->id)->get();
                
                $lessonsCount = Lesson::where('course_id', $course->id)->where('published', 1)->count();

                //$subscribes = Subscribe::where('course_id', $course->id)->with('subscribedUsersByCourse')->get();
                //$subscribes = Course::find(1)->users()->get();
    
                // If need get users by category
                $subscribes = Course::find($course->id)->users()->get();

                // If need get categories by user
                //$subscribes=User::find(2)->courses()->get();
                return view('course', compact('course', 'lessons', 'subscribes', 'lessonsCount'));
            } else {

                return redirect()->back()->withSuccess('Доступ до курсу закритий');
            }
        } 

        echo '<h1 style="text-align: center; font-size: 40px; padding-top: 160px; font-weight: bold;font-family: Verdana; margin-bottom: 20px;">404</h1><p style="text-align: center; font-family: Verdana;">Сторінка не знайдена</p>';
        //return view('courses');
    }
    


    
}
