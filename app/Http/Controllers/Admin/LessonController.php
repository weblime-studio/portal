<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {        
        $lessons = Lesson::with('lessonCourse')->get();                  
        $courses = Course::select('id','name')->orderBy('created_at', 'desc')->get();

        return view('admin.lesson.index', compact('lessons', 'courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Select courses for choose lesson belongs to
        $courses = Course::select('id','name')->orderBy('created_at', 'desc')->get();
        return view('admin.lesson.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $lesson = new Lesson();

        if ($request->isMethod('post') && $request->file('preview')) {

            $file = $request->file('preview');
            $upload_folder = 'public/lesson';

        
            $filename = date('d-m-Y_m.s_') . $file->getClientOriginalName();
    
            $preview = Storage::putFileAs($upload_folder, $file, $filename);
            
            $lesson->preview = str_replace('public/', 'storage/', $preview);
        }
        
        $lesson->name = $request->name;
        $lesson->slug = $request->slug;
        
        $lesson->video = $request->video;        
        $lesson->excerpt = $request->excerpt;
        $lesson->description = $request->description;
        $lesson->task = $request->task;
        $lesson->published = $request->published == 'on' ? 1 : 0;
        $lesson->course_id = $request->course_id;

        $lesson->save();

        return redirect()->back()->withSuccess('Урок успішно додано');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {     
        $courses = Course::select('id','name')->orderBy('created_at', 'desc')->get();

        return view('admin.lesson.edit', compact('lesson', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        if ($request->isMethod('put') && $request->file('preview')) {

            $file = $request->file('preview');
            $upload_folder = 'public/lesson';

        
            $filename = date('d-m-Y_m.s_') . $file->getClientOriginalName();
    
            $preview = Storage::putFileAs($upload_folder, $file, $filename);
            
            $lesson->preview = str_replace('public/', 'storage/', $preview);
        }
        
        $lesson->name = $request->name;
        $lesson->slug = $request->slug;
        
        $lesson->video = $request->video;        
        $lesson->excerpt = $request->excerpt;
        $lesson->description = $request->description;
        $lesson->task = $request->task;
        $lesson->published = $request->published == 'on' ? 1 : 0;
        $lesson->course_id = $request->course_id;

        $lesson->save();

        return redirect()->back()->withSuccess('Урок успішно обновлено');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        //
    }
}
