@extends('layouts/admin')


@section('title')
{{ $course['name'] }}
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">{{ $course['name'] }}</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>    
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="card card-default">
                    <div  class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="video" readonly value="{{ $course['video'] }}" placeholder="Відео посилання">
                        </div>
                        <div class="form-group">
                            {!! $course['excerpt'] !!}
                        </div>
                        <div class="form-group">
                            {!! $course['description'] !!}
                        </div>                    
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-default">
                    <div  class="card-body">
                        <div class="card-header" style="padding-left: 0;">
                            <h4 class="card-title"><label>Налаштування уроку</label></h4>                                 
                        </div>
                        <div class="form-group">  
                            <label>Опубліковано</label>
                            <div class="input-group">                                
                                <input type="checkbox" name="published" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <input type="text" class="form-control" name="start" value="{{ $course->start }}" id="course-start" placeholder="Дата початку">
                        </div> 

                        <div class="form-group">
                            <input type="text" class="form-control" name="duration" value="{{ $course->duration }}" placeholder="Тривалість курсу">
                        </div> 

                        

                        <div class="form-group">
                            <label>Виберіть автора курса</label>
                            <div class="select2-purple">
                                <select class="select2" name="author[]"  multiple="multiple" data-placeholder="Автори курсу" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                    <option  disabled="" value="0">Виберіть автора</option>
                                    @foreach($editors as $editor)
                                    <option value="{{ $editor->id }}" {{ $course["author"] == $editor->id ? 'selected':'' }}>{{ $editor->name }}</option>
                                    @endforeach                                
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Виберіть рубрику курсу</label>
                            <div class="select2-purple">
                                
                                <select class="select2" name="category" value="{{ $course['category'] }}" data-placeholder="Рубрика" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                    <option value="0" disabled="" selected>Виберіть рубрику курсу</option>
                                    <option value="Живопис" {{ $course["category"] == 'Живопис' ? 'selected':'' }}>Живопис</option>
                                    <option value="Краєзнавство" {{ $course["category"] == 'Краєзнавство' ? 'selected':'' }}>Краєзнавство</option>
                                    <option value="Історія краю" {{ $course["category"] == 'Історія краю' ? 'selected':'' }}>Історія краю</option>
                                    <option value="Фото" {{ $course["category"] == 'Фото' ? 'selected':'' }}>Фото</option>                                        
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="preview cover flex" style="margin-bottom: 20px;"><img src="/{{ $course['preview'] }}" /></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


<div class="chart" style="display: none;">
        <!-- Sales Chart Canvas -->
        <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
</div>
<div class="chart-responsive"style="display: none;">
    <canvas id="pieChart" height="150"></canvas>
</div>

@endsection
