@extends('layouts/admin')

@section('title', 'Підписки на курс')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Підписку успішно видалено</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Підписки </h1>
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
                        <h3 class="card-title">Список підписчиків</h3>
                        <div class="card-tools">
                            <button class="btn btn-tool" data-card-widget="collapse" title="Collapse" type="button"><i class="fas fa-minus"></i></button> <button class="btn btn-tool" data-card-widget="remove" title="Remove" type="button"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="filter " style="padding: 12px;">
                            <div class="form-group row">
                                <div class="col-4">                                    
                                    <div>
                                        <label>Пошук по назві курсу:</label>
                                        <div class="select2-purple">
                                            <select class="select2" name="course" data-placeholder="Урок" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option value="0" disabled selected>Введіть назву курсу</option>
                                                @foreach($courses as $key => $course)
                                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">                                  
                                    <div>
                                        <label>Пошук по імені користувача:</label>
                                        <div class="select2-purple">
                                            <select class="select2" name="user" data-placeholder="Курс" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option value="0" disabled selected>Введіть ім'я користувача</option>    
                                                @foreach($users as $key => $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
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
                                    <th style="width: 20%">Курс</th>
                                    
                                    <th style="width: 20%">Студент</th>
                                    
                                    <th>Пройдено уроків</th>
                                    <th style="width: 10%">Статус підписки</th>
                                    <th style="width: 20%"></th>
                                </tr>
                                
                            </thead>
                            <tbody>

                            @foreach($subscribes as $subscribe)        
                                <tr>
                                    <td>{{ $subscribe->id }}</td>
                                    <td>                                    
                                        <a class="flex cover" target="_blank" href="/myadmin/course/{{ $subscribe->course_id }}/edit"><?php echo App\Models\Course::find($subscribe->course_id)->name; ?></a>
                                    </td>
                                    
                                    <td>
                                        <a target="_blank" href="/myadmin/user/{{ $subscribe->user_id }}/edit"><?php echo App\Models\User::find($subscribe->user_id)->name; ?></a><br>
                                    </td>
                                    
                                    
                                    
                                    <td class="project_progress">
                                        <div class="flex"><small>2</small> <span class="badge bg-danger">55%</span></div>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-warning" style="width: 96%"></div>
                                        </div>
                                    </td>    
                                    @if($subscribe->signed)
                                        <td class="project-state" style="text-align: left;"><span class="badge badge-success">Опубліковано</span></td>
                                    @else
                                        <td class="project-state" style="text-align: left;"><span class="badge badge-danger">Не опубліковано</span></td>
                                    @endif                                
                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm" href="{{ route('subscribe.edit', $subscribe->id) }}"><i class="fas fa-pencil-alt"></i> Ред.</a>
                                        <form action="{{ route('subscribe.destroy', $subscribe->id) }}" style="display: inline-block;" method="POST">
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