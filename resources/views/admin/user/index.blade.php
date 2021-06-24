@extends('layouts/admin')

@section('title', 'Список користувачів')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Всі користувачі</h1>
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
                        <h3 class="card-title">Список користувачів</h3>
                        <div class="card-tools">
                            <button class="btn btn-tool" data-card-widget="collapse" title="Collapse" type="button"><i class="fas fa-minus"></i></button> <button class="btn btn-tool" data-card-widget="remove" title="Remove" type="button"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="filter " style="padding: 12px;">
                            <div class="form-group row">
                                <div class="col-4">                                    
                                    <div>
                                        <label>Пошук по імені:</label>
                                        <div class="select2-purple">
                                            <select class="select2" name="category" data-placeholder="Ім'я" data-dropdown-css-class="select2-purple" style="width: 100%;">
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
                                    <th style="width: 5%">Аватар</th>
                                    
                                    <th style="width: 16%">Ім'я</th>
                                    <th style="width: 30%">Підписки на курси</th>
                                    <th style="width: 10%">Роль</th>
 
                                    <th style="width: 8%" style="text-align: left;">Статус</th>
                                    <th style="width: 20%"></th>
                                </tr>                                
                            </thead>
                            <tbody>
                                <?php
                                    $roleNames = array(
                                        'user'=>'Без статуса',
                                        'admin'=>'Адміністратор',                                        
                                        'editor'=>'Коуч',
                                        'student'=>'Студент'
                                    );
                                ?>                         
                                @foreach($users as $key => $user)
                                <tr>
                                <td>{{ $user->id }}</td>
                                    <td>
                                    @if($user->profile_photo_path)
                                        <a class="flex cover" href="/user/{{ $user->id }}" style="width: 70px;height: 70px;border-radius: 100px;overflow: hidden"><img src="/storage/{{ $user->profile_photo_path }}" ></a>
                                    @else
                                        <a class="flex cover" href="/user/{{ $user->id }}" style="width: 70px;height: 70px;border-radius: 100px;overflow: hidden"><img src="/images/user-default.png" alt="{{  $user->name }}"></a>
                                    @endif
                                    </td>
                                    
                                    <td>
                                        <a href="/user/{{ $user->id }}">{{ $user->name }}</a><br>
                                        <small>Початок {{ $user->created_at }}</small>
                                    </td>
                                    <td>
                                    @foreach($subscribes as $subscribe)
                                    <li class="list-inline-item flex flex-m"><a href="/myadmin/user/1" class="cover flex" style="width: 50px; height: 50px;">
                                    {{ $subscribe->name }}
                                        
                                    </a>&nbsp;</li>
                                    @endforeach
                                    </td>
                                    <td>
                                       {{ $roleNames[$user->roles->first()->name] }}
                                    </td>
                                    <td class="project-state" style="text-align: left;">
                                        @if($user->roles->first()->name == 'user')
                                            <span class="badge badge-danger">Не опубліковано</span>
                                        @else
                                            <span class="badge badge-success">Опубліковано</span>
                                        @endif
                                    </td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-primary btn-sm" href="/user/{{ $user->id }}"><i class="fa fa-eye"></i> Див.</a> 
                                        <a class="btn btn-info btn-sm" href="{{ route('user.edit', $user->id) }}"><i class="fas fa-pencil-alt"></i> Ред.</a> 
                                        <form action="{{ route('user.destroy', $user->id) }}" style="display: inline-block;" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button  class="btn btn-danger btn-sm delete-btn" ><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
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