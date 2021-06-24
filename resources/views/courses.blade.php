@extends('layouts/layout')
<div class="course-page">
    <div class="inside">
        <div class="title"><span>Курси</span></div>
        @if(session('success'))

            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Доступ до курсу закритий. Ви можите отримати його подавши завку адміністратору</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="list flex flex-s">
            
            @foreach($courses as $course)
                <?php $signed = false; ?>
                @if( Auth::check() )
                    <?php 
                        $mySubscribe = App\Models\Subscribe::where('user_id', Illuminate\Support\Facades\Auth::id())->where('course_id', $course->id)->first(); 

                        if( isset($mySubscribe) && $mySubscribe->signed == true) {
                            $signed = true;
                        }
                    ?>
                @endif
                <div class="item course-{{ $signed }}" attr-course-id="{{ $course->id }}">
                    @if( $signed == false )
                    <div class="overlay flex flex-c flex-m">
                        <div class="overlay-inner">
                            <!--<a href="/course/{{ $course->slug }}">Link</a>-->
                            
                            @if( Auth::check() == false )
                                <div class="button"><a href="/login">Вхід</a></div>
                            @else
                                <div class="button"><a href="#get-course-access" class="fancybox get-course-button"  attr-course-id="{{ $course->id }}" attr-course-name="{{ $course->name }}">Отримати доступ</a></div>
                            @endif
                        </div>
                    </div>
                    @endif
                    <div class="item-inner">
                        <div class="image cover flex">
                            @if( $signed == true )
                                <a href="course/{{ $course->slug }}"><img src="{{ $course->preview }}" alt=""></a>                        
                            @else
                                <img src="{{ $course->preview }}" alt="">
                            @endif
                        </div>
                        <div class="description">
                            <div class="category">{{ $course->category }}</div>
                            <div class="name">
                                @if( $signed == true )
                                    <a href="course/{{ $course->slug }}">{{ $course->name }}</a>                        
                                @else
                                    {{ $course->name }}
                                @endif                        
                            </div>
                            <div class="desc">
                                <p>{!! $course->excerpt !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
            @endforeach
            <div class="item hidden"></div>
        </div>

        <div id="request-sent" class="request-sent">
            <div class="inner">
                <h3>Запит на проходження курсу надіслано, курс буде доступний після підтвердження адміністратором</h3>
            </div>
        </div>
        <div id="get-course-access" class="get-course-access-form">
            <div class="inner">
                <h3><strong>Вітаємо!</strong> Цим запитом Ви отримаєте доступ до курсу «<span></span>». Курс для Вас буде доступний після підтвердження адміністратором, і буде Вас повідомлено в особистому кабінеті а також на вказаний E-mail в налаштуваннях профіля.</h3>
                <!--<div class="button"><a href="#request-sent" class="fancybox">Отримати доступ</a></div>-->
                <input type="hidden" name="course-id" />
                <div class="button"><button>Отримати доступ</button></div>
            </div>
        </div>

        <a href="#request-sent" class="click-request-sent fancybox" style="display: none;"></a>
    </div>
</div>