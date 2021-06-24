<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$courses = Course::orderBy('created_at', 'desc')->get();

        $courses = Course::with('lessons')->get();

        //$subscribes = Course::find(1)->users()->limit(5)->get();
        //$subscribesCount = Course::find(1)->users()->count();

        return view('admin.course.index', compact('courses'/*, 'subscribes', 'subscribesCount'*/));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $editors = User::select('id','name')->whereHas("roles", function($q) {
            $q->where("name", "editor");
        })->get();
        return view('admin.course.create', compact('editors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //HOOK later remove correctly

        $course = new Course();
        $course->name = $request->name;
        $course->slug = $request->slug;

        if ($request->isMethod('post') && $request->file('preview')) {

            $file = $request->file('preview');
            $upload_folder = 'public/courses';

        
            $filename = date('d-m-Y_m.s_') . $file->getClientOriginalName();
    
            $preview = Storage::putFileAs($upload_folder, $file, $filename);    

            $course->preview = str_replace('public/', 'storage/', $preview);
        }

        
        $course->video = $request->video;
        $course->author = implode(',', $request->author);
        $course->excerpt = $request->excerpt;
        $course->duration = $request->duration;
        $course->description = $request->description;
        $course->published = $request->published == 'on' ? 1 : 0;
        $course->category = $request->category;

        $course->save();

        return redirect()->back()->withSuccess('Курс успішно додано');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course) {
        //Not done by _DS
        $editors = User::select('id','name')->where("id", $course['user_id']);
        return view('admin.course.show', compact('course', 'editors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $editors = User::select('id','name')->whereHas("roles", function($q) {
            $q->where("name", "editor");
        })->get();

        $courseLessons = Lesson::select('*')->where("course_id", $course->id)->get();
        
        return view('admin.course.edit', compact('course', 'editors', 'courseLessons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        if ($request->isMethod('put') && $request->file('preview')) {

            $file = $request->file('preview');
            $upload_folder = 'public/courses';

        
            $filename = date('d-m-Y_m.s_') . $file->getClientOriginalName();
    
            $preview = Storage::putFileAs($upload_folder, $file, $filename); 
            
            $course->preview = str_replace('public/', 'storage/', $preview);
        }
        
        $course->name = $request->name;
        $course->slug = $request->slug;
        $course->video = $request->video;
        $course->author = implode(',', $request->author);
        $course->excerpt = $request->excerpt;
        $course->description = $request->description;
        $course->duration = $request->duration;
        $course->published = $request->published == 'on' ? 1 : 0;
        $course->category = $request->category;

        $course->save();

        return redirect()->back()->withSuccess('Курс успішно обновлено');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        

        $subscribe = Subscribe::select()->where("course_id", $course->id)->get();
        $subscribe->delete();

        $course->delete();

        return redirect()->back()->withSuccess('Курс успішно видалено');
    }
}
