<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Course;

class LessonController extends Controller
{
    public function lesson($slug) {
        $lesson = Lesson::where('slug', $slug)->first();
        
        if( isset($lesson->id) ) {
            $course = Course::orderBy('created_at', 'desc')->where('id', $lesson->course_id)->first();

            $subscribes = Course::find($lesson->course_id)->users()->get();
            $lessonsCount = Lesson::where('course_id', $lesson->course_id)->where('published', '1')->count();
        
            return view('lesson', compact('lesson', 'course', 'subscribes', 'lessonsCount'));
        } 

        echo '<h1 style="text-align: center; font-size: 40px; padding-top: 160px; font-weight: bold;font-family: Verdana; margin-bottom: 20px;">404</h1><p style="text-align: center; font-family: Verdana;">Сторінка не знайдена</p>';
    }
}
