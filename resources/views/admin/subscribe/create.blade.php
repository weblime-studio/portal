@extends('layouts/admin')


@section('title', 'Редагування користувача')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Підписка активована</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Керування підпискою</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>    
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <form action="{{ route('subscribe.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="filter " style="padding: 12px;">
                        <div class="form-group row">
                            <div class="col-4">                                    
                                <div>
                                    <label>Користувач:</label>
                                    <div class="select2-purple">
                                        <select class="select2" name="user_id" data-placeholder="Курс" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                            <option value="0" disabled selected>Введіть ім'я користувача</option>
                                            @foreach($users as $key => $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">                                    
                                <div>
                                    <label>Курс:</label>
                                    <div class="select2-purple">
                                        <select class="select2" name="course_id" data-placeholder="Курс" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                            <option value="0" disabled selected>Введіть назву курсу</option>
                                            @foreach($courses as $key => $course)
                                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success">Відправити</button>
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