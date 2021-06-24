@extends('layouts/admin')


@section('title')
Редагувати курс
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Курс успішно відредаговано</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Редагувати курс</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>    
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <form action="{{ route('course.update', $course['id']) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-9">
                    <div class="card card-default">
                        <div  class="card-body">
                    
                        
                            <div class="form-group">             
                                <input type="text" class="form-control" name="name" value="{{ $course['name'] }}" placeholder="Назва курсу">
                            </div>
                            <div class="form-group">            
                                <input type="text" class="form-control" name="slug" value="{{ $course['slug'] }}"  placeholder="Аліас (Латиницею)">
                            </div>
                            
                            

                            <div class="form-group">
                                <textarea class="form-control summernote short" name="excerpt" rows="3" placeholder="Короткий опис ...">{{ $course->excerpt }}</textarea>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control summernote full" name="description" rows="8" placeholder="Повний опис ...">{{ $course->description }}</textarea>
                            </div>
                            
                            
                        
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-default">
                        <div  class="card-body">
                            <div class="form-group">  
                                <label>Опубліковано</label>
                                <div class="input-group">
                                    <input type="checkbox" name="published" {{ $course->published == 1 ? 'checked' :'' }} data-bootstrap-switch data-off-color="danger" data-on-color="success">
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
                                @if($course->preview)
                                <div class="preview cover flex" style="margin-bottom: 20px;"><img src="/{{ $course['preview'] }}" /></div>
                                @endif
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="preview" id="preview">
                                        <label class="custom-file-label" for="preview">Зображення</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Завантажити</span>
                                    </div>
                                </div>
                            </div>
                            

                            
                            <div class="form-group">  
                            @if($course->video)                              
                                <div><iframe src="{{ $course['video'] }}" frameborder="0" width="100%" height="230"></iframe></div>                                
                            @endif     
                            <input type="text" class="form-control" name="video" value="{{ $course['video'] }}" placeholder="Відео посилання">                           
                            </div>
                            

                            <div class="form-group">
                                <button class="btn btn-success">Зберегти</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="lesson-list">
            <table class="table table-striped projects">
                <thead>
                    
                    <tr>
                        <th style="width: 3%">ID</th>
                        <th style="width: 3%">Постер</th>                        
                        <th style="width: 34%">Назва уроку</th>
                        <th style="width: 8%">Статус уроку</th>
                        <th style="width: 20%"></th>
                    </tr>
                    
                </thead>
                <tbody>
                @foreach($courseLessons as $lesson)
                    <tr>
                        <td>{{ $lesson->id }}</td>
                        <td>
                            @if($lesson->preview)
                                <a class="flex cover" target="_blank" href="/lesson/{{ $lesson['slug']}}" style="width: 80px;height: 70px;"><img src="/{{ $lesson->preview }}" ></a>
                            @endif
                        </td>
                        <td><a href="/myadmin/lesson/{{ $lesson->id }}/edit/">{{ $lesson->name }}</a></td>
                        @if($lesson->published)
                            <td class="project-state" style="text-align: left;"><span class="badge badge-success">Опубліковано</span></td>
                        @else
                            <td class="project-state" style="text-align: left;"><span class="badge badge-danger">Не опубліковано</span></td>
                        @endif
                        <td class="project-actions text-right">
                            <input type="text" placeholder="" class="form-control" style="text-align:center;padding-left: 5px; width: 30px; padding-right: 5px;height: 30px; display: inline-block; vertical-align: bottom;" name="ordering" value="0">
                            <a class="btn btn-primary btn-sm" target="_blank" href="/lesson/{{ $lesson['slug'] }}"><i class="fa fa-eye"></i> Див.</a> 
                            <a class="btn btn-info btn-sm" href="{{ route('lesson.edit', $lesson['id']) }}"><i class="fas fa-pencil-alt"></i> Ред.</a> 
                            <form action="{{ route('lesson.destroy', $lesson->id) }}" style="display: inline-block;" method="POST">
                                @csrf
                                @method('DELETE')
                                <button  class="btn btn-danger btn-sm delete-btn" ><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>        
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

@section('pagescripts')
<script>
        $('form input[name="name"]').on('input', function() {
            
            String.prototype.translit = String.prototype.translit || function () {
                var Chars = {
                    'а':'a','б':'b','в':'v','г':'g','д':'d','е':'e','ё':'yo','ж':'zh','з':'z','и':'i','й':'y','к':'k','л':'l','м':'m','н':'n','о':'o','п':'p','р':'r','с':'s','т':'t','у':'u','ф':'f','х':'h','ц':'c','ч':'ch','ш':'sh','щ':'shch','ъ':'','ы':'y','ь':'','э':'e','ю':'yu','я':'ya','і':'i','ї':'ji','ґ':'g',' ':'-','_':'-','a':'a','b':'b','c':'c','d':'d','e':'e','f':'f','g':'g','h':'h','i':'i','j':'j','k':'k','l':'l','m':'m','n':'n','o':'o','p':'p','q':'q','r':'r','s':'s','t':'t','u':'u','v':'v','w':'w','x':'x','y':'y','z':'z'
                },
                t = this;
                
                for (var i in Chars) {  
                    // console.log(i + ' * ' + Chars[i])
                    t = t.replace(new RegExp(i, 'g'), Chars[i]);                    
                }
                return t;
            };

            var slugNotTranslated = $(this).val().toLowerCase();

            $('form input[name="slug"]').val(slugNotTranslated.translit());
        })
    </script>
@endsection