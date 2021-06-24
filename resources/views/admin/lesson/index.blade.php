@extends('layouts/admin')

@section('title', 'Список курсів')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Всі уроки</h1>
            </div>
        </div>
    </div>    
</div>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Список уроків</h3>
                        
                        <div class="card-tools">
                            <button class="btn btn-tool" data-card-widget="collapse" title="Collapse" type="button"><i class="fas fa-minus"></i></button> <button class="btn btn-tool" data-card-widget="remove" title="Remove" type="button"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="filter " style="padding: 12px;">
                            <div class="form-group row">
                                <div class="col-4">                                    
                                    <div>
                                        <label>Пошук по назві уроку:</label>
                                        <div class="select2-purple">
                                            <select class="select2" name="category" data-placeholder="Урок" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option value="0" disabled selected>Введіть назву уроку</option>
                                                @foreach($lessons as $key => $lesson)
                                                    <option value="{{ $lesson->id }}">{{ $lesson->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">                                  
                                    <div>
                                        <label>Пошук по назві курсу:</label>
                                        <div class="select2-purple">
                                            <select class="select2" name="category" data-placeholder="Курс" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option value="0" disabled selected>Введіть назву курсу</option>    
                                                @foreach($courses as $key => $course)
                                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped projects">
                            <thead>
                               
                                <tr>
                                <th style="width: 3%">ID</th>
                                    <th style="width: 5%">Постер</th>
                                    
                                    <th style="width: 30%">Назва уроку</th>
                                    <th style="width: 16%">Курс</th>
                              
                                    <th style="width: 8%">Статус</th>
                                    <th style="width: 20%"></th>
                                </tr>
                                
                            </thead>
                            <tbody>
                         
                                @foreach($lessons as $key => $lesson)
                                <tr attr-filter-by-lesson="{{ $lesson->name }}" attr-filter-by-course="{{ $lesson->name }}">
                                <td>{{ $lesson->id }}</td>
                                    <td>
                                    @if($lesson->preview)
                                        <a class="flex cover" href="/lesson/{{ $lesson['slug'] }}" style="width: 80px;height: 70px;"><img src="/{{ $lesson->preview }}" ></a>
                                    @endif
                                    </td>                                    
                                    <td>
                                        <a href="/lesson/{{ $lesson['slug'] }}" target="_blank">{{ $lesson->name }}</a><br>
                                        <small>Початок {{ $lesson->created_at }}</small>
                                    </td>
                                    <td>
                                        <a href="{{ $lesson->slug }}">{{ $lesson->name }}</a>
                                    </td>
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
                                    <!--<td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm" href="#"><i class="fa fa-eye"></i> Пер.</a> 
                                        <a class="btn btn-info btn-sm" href="#"><i class="fas fa-pencil-alt"></i> Ред.</a> 
                                        <a class="btn btn-danger btn-sm" href="#"><i class="fas fa-trash"></i></a>
                                    </td>-->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.card-body -->
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
@section('pagescripts')
<script>
    
</script>
@endsection