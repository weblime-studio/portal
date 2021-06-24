<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Http\Request;
use Mockery\Matcher\Subset;

class SubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $subscribes = Subscribe::orderBy('created_at', 'desc')->get();
        if(isset( $_GET['show'] ) && $_GET['show'] == 'new') {
            $subscribes = Subscribe::orderBy('created_at', 'desc')->where('signed', 0)->get();
        }         


        $courses = Course::orderBy('name', 'asc')->get();
        $users = User::orderBy('name', 'asc')->get();
        
        return view('admin.subscribe.index', compact('subscribes', 'courses', 'users'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::select('id','name')->get();
        $users   = User::select('id','name')->get();

        return view('admin.subscribe.create', compact('courses', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subscribe = new Subscribe();
        $subscribe->course_id = $request->course_id;
        $subscribe->user_id = $request->user_id;

        $subscribe->save();

        return redirect()->back()->withSuccess('Підписку додано');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscribe  $subscribe
     * @return \Illuminate\Http\Response
     */
    public function show(Subscribe $subscribe)
    {
        //$editors = User::select('id','name')->where("id", $course['user_id']);
        return view('admin.subscribe.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscribe  $subscribe
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscribe $subscribe)
    {
        $courses = Course::select('id','name')->get();
        $users   = User::select('id','name')->get();

        return view('admin.subscribe.edit', compact('subscribe', 'courses', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscribe  $subscribe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscribe $subscribe)
    {
        $subscribe->course_id = $request->course_id;
        $subscribe->user_id = $request->user_id;
        $subscribe->signed = $request->signed == 'on' ? 1 : 0;

        $subscribe->save();
        return redirect()->back()->withSuccess('Підписка створена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscribe  $subscribe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscribe $subscribe)
    {
        $subscribe->delete();
        return redirect()->back()->withSuccess('Підписка видалена');
    }   

}
