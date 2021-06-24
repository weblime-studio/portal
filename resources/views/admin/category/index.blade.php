@extends('layouts/admin')

@section('title', 'Категорії')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Катуггорію створено</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Категорії &nbsp;&nbsp;&nbsp;<a href="{{ route('category.create') }}" class="btn btn-success">Створити категорію</a></h1>
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
                        <h3 class="card-title">Список категорій</h3>
                        <div class="card-tools">
                            <button class="btn btn-tool" data-card-widget="collapse" title="Collapse" type="button"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="filter " style="padding: 12px;">
                            <div class="form-group row">
                                <div class="col-4">                                    
                                    <div>
                                        <label>Пошук по назві категорії:</label>
                                        <div class="select2-purple">
                                            <select class="select2" name="category" data-placeholder="Категорія" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option value="0" disabled selected>Введіть назву категорії</option>
                                                @foreach($categories as $key => $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                    
                                    <th style="width: 24%">Назва курсу</th>
                                    <th style="width: 24%">Учасники</th>
                                    <th>Уроків / Тривалість</th>
                                    <th style="width: 8%">Статус курсу</th>
                                    <th style="width: 20%"></th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                @foreach($categories as $category)

                                    
                                <tr>
                                <td>{{ $category->id }}</td>
                                <td>
                                    @if($category->preview)
                                        <a class="flex cover" target="_blank" href="/category/{{ $category['slug']}}" style="width: 80px;height: 70px;"><img src="/{{ $category->preview }}" ></a>
                                    @endif
                                </td>
                                    
                                    <td>
                                        <a target="_blank" href="/category/{{ $category['slug']}}">{{ $category->name }}</a><br>
                                        <small>Початок {{ $category->created_at }}</small>
                                    </td>
                                    <td>
                                        <ul class="list-inline flex flex-l">
                                            @foreach($subscribes as $subscribe)
                                            <li class="list-inline-item flex flex-m"><a href="/myadmin/user/{{ $subscribe->id }}/edit" class="cover flex" style="width: 50px; height: 50px;">
                                                @if($subscribe->profile_photo_path)
                                                <img alt="{{ $subscribe->name }}" class="table-avatar" src="/storage/{{ $subscribe->profile_photo_path }}">
                                                @else
                                                <img alt="{{ $subscribe->name }}" class="table-avatar" src="/images/user-default.png">
                                                @endif
                                            </a>&nbsp;</li>
                                            @endforeach
                                            {{ $subscribesCount > 5 ? '<li>+' . ($subscribesCount-5) . '</li>' : '' }}
                                        </ul>
                                    </td>
                                    <td class="project_progress">
                                        <small>10 / {{ $category->duration }}</small>
                                    </td>
                                    @if($category->published)
                                        <td class="project-state" style="text-align: left;"><span class="badge badge-success">Опубліковано</span></td>
                                    @else
                                        <td class="project-state" style="text-align: left;"><span class="badge badge-danger">Не опубліковано</span></td>
                                    @endif                                    
                                    <td class="project-actions text-right">
                                        <input type="text" placeholder="" class="form-control" style="text-align:center;padding-left: 5px; width: 30px; padding-right: 5px;height: 30px; display: inline-block; vertical-align: bottom;"  name="ordering" value="0">
                                        <a class="btn btn-primary btn-sm" target="_blank" href="/category/{{ $category['slug']}}"><i class="fa fa-eye"></i> Див.</a> 
                                        <a class="btn btn-info btn-sm" href="{{ route('category.edit', $category['id']) }}"><i class="fas fa-pencil-alt"></i> Ред.</a> 
                                        <form action="{{ route('category.destroy', $category->id) }}" style="display: inline-block;" method="POST">
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