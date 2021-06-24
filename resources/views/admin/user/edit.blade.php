@extends('layouts/admin')


@section('title', 'Редагування користувача')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Профіль оновлено</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Редагування профіля користувача</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>    
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-9">
                    <div class="card card-default">
                        <div  class="card-body">
                            <div class="form-group">     
                                <label>Ім'я користувача</label>        
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Ім'я">
                            </div>                        
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-default">
                        <div  class="card-body">
                            
                            <div class="form-group">
                                <label>Виберіть роль користувача</label>
                                <?php

                                    $roleNames = array(
                                        'user'=>'Без статуса ( не підтверджений )',
                                        'admin'=>'Адміністратор',                                        
                                        'editor'=>'Коуч',
                                        'student'=>'Студент'
                                    );
                                ?>
                                <div class="select2-purple">
                                    <select class="select2" name="role" data-placeholder="Курс" data-dropdown-css-class="select2-purple" style="width: 100%;">        
                                        <option disabled="" value="0">Виберіть роль користувача</option>
                                        @foreach($roles as $role)                                          
                                            <option value="{{ $role->name }}" {{ $user->roles->first()->name == $role->name ? 'selected':'' }}>{{ $roleNames[$role->name] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @if($user->profile_photo_path)
                            <div class="cover flex form-group" style="width: 100px; height: 100px;"><img src="/storage/{{ $user->profile_photo_path }}" ></div>
                            @endif
                            <div class="form-group">
                                <button class="btn btn-success">Зберегти</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="card card-default">
            <div class="card-body">
                <div>
                    <h3>Підписки цього студента</h3>
                </div>
                <table class="table table-striped projects">
                    <thead>                
                        <tr>
                        <th style="width: 3%">ID</th>
                            <th style="width: 5%">Постер</th>                    
                            <th style="width: 40%">Назва курсу</th>
                            <th style="width: 15%">Статус підписки</th>
                            <th style="width: 15%">Пройдено уроків</th>
                            <th style="width: 25%"></th>
                        </tr>                
                    </thead>
                    <tbody>        
                    @foreach($subscribes as $subscribe)
                        <tr>
                            <td>{{ $subscribe->id }}</td>
                            <td>
                                @if($subscribe->preview)
                                    <a class="flex cover" target="_blank" href="/course/{{ $subscribe['slug']}}" style="width: 80px;height: 70px;"><img src="/{{ $subscribe->preview }}" ></a>
                                @endif
                            </td>
                            <td>
                                <a target="_blank" href="/course/{{ $subscribe['slug']}}">{{ $subscribe->name }}</a><br>
                                <small>Початок {{ $subscribe->created_at }}</small>
                            </td>
                            <td>Активний</td>
                            <td class="project_progress">
                                <div class="flex"><small>2</small> <span class="badge bg-danger">55%</span></div>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-warning" style="width: 96%"></div>
                                </div>
                            </td> 
                            <td align="right">
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
                    //console.log(i + ' * ' + Chars[i])
                    t = t.replace(new RegExp(i, 'g'), Chars[i]);                    
                }
                return t;
            };

            var slugNotTranslated = $(this).val().toLowerCase();

            $('form input[name="slug"]').val(slugNotTranslated.translit());
        })
    </script>
@endsection