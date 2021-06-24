@extends('layouts/admin')


@section('title', 'Створити новий курс')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Курс успішно створено</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Створити новий курс</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>    
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <form action="{{ route('course.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-9">
                    <div class="card card-default">
                        <div  class="card-body">
                    
                        
                            <div class="form-group">             
                                <input type="text" class="form-control" name="name" placeholder="Назва курсу">
                            </div>
                            <div class="form-group">            
                                <input type="text" class="form-control" name="slug" placeholder="Аліас (Латиницею)">
                            </div>
                            
                            <div class="form-group">
                                <input type="text" class="form-control" name="video" placeholder="Відео посилання">
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" name="excerpt" rows="3" placeholder="Короткий опис ..."></textarea>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="description" rows="4" placeholder="Повний опис ..."></textarea>
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
                                    <input type="checkbox" name="published" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <input type="text" class="form-control" name="start" id="course-start" placeholder="Дата початку">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="duration" placeholder="Тривалість курсу">
                            </div> 

                            <div class="form-group">
                                <label>Виберіть автора курса</label>
                                <div class="select2-purple">
                                    <select class="select2" name="author[]"  multiple="multiple" data-placeholder="Автори курсу" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                        <option  disabled="" value="0">Виберіть автора</option>
                                        @foreach($editors as $editor)
                                        <option value="{{ $editor->id }}">{{ $editor->name }}</option>
                                        @endforeach                                
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Виберіть рубрику курса</label>
                                <div class="select2-purple">
                                    <select class="select2" name="category" data-placeholder="Рубрика" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                        <option>Живопис</option>
                                        <option>Краєзнавство</option>
                                        <option>Історія краю</option>
                                        <option>Фото</option>                                        
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="preview" id="preview">
                                        <label class="custom-file-label" for="preview">Виберіть файл</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Завантажити</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-success">Зберегти</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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