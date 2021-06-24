@extends('layouts/layout')
<div class="article-poster">
    <div class="inside">
        <div class="cat"><span>{{ $course->name }}</span></div>
        <div class="title">Урок: {{ $lesson['name'] }}</div>
    </div>    
</div>
<div class="article-detail">
    <div class="inside">
        <div class="flex flex-t">
            <div class="content">
                <div class="lesson-main-tabulation flex flex-s">
                    <div class="tab-item back"><a href="/course/{{ $course->slug }}" class="flex"><img src="/images/back.png" alt=""> <span>Назад до курсу</span></a></div>
                    <div class="tab-item tab-btn active"><span>Матеріали</span></div>
                    <div class="tab-item tab-btn"><span>Відео</span></div>
                    <div class="tab-item tab-btn"><span>Завдання</span></div>
                </div>
                <div class="tab-content">
                    <div class="active content-item">
                        <h3>Опис уроку</h3>
                        {!! $lesson->description !!}
                    </div>
                    <div class="content-item">
                        <h3>Відео уроку</h3>
                        <div class="video youtube-video">
                            <div class="inline-relative">
                                <img src="/images/videoframe.jpg" alt="">
                                <iframe src="{{ $lesson->video }}"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="content-item">
                        <h3>Завдання до уроку</h3>
                        {!! $lesson->task !!}
                        
                        <div class="chat-with-teacher" style="margin-top: 50px;">
                            <div class="card card-warning direct-chat direct-chat-warning shadow">
                                <div class="card-header">
                                    <h4 class="card-title"><strong>Чат по виконанню завдання</strong></h4>

                                    <div class="card-tools">
                                    <!--<span title="3 New Messages" class="badge bg-danger">3</span>-->
                                    <!--<button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                                        <i class="fas fa-comments"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>-->
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <!-- Conversations are loaded here -->
                                    <div class="direct-chat-messages">
                                    <!-- Message. Default to the left -->
                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-infos clearfix">
                                        <span class="direct-chat-name float-left">Alexander Pierce</span>
                                        <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                                        </div>
                                        <!-- /.direct-chat-infos -->
                                        <img class="direct-chat-img" src="/storage/profile-photos/AHZbjimcmqUXXEgIpc40kOSUlSh7Ugbfa6YgHOWv.png" alt="Message User Image">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                        Is this template really for free? That's unbelievable!
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->

                                    <!-- Message to the right -->
                                    <div class="direct-chat-msg right">
                                        <div class="direct-chat-infos clearfix">
                                        <span class="direct-chat-name float-right">Sarah Bullock</span>
                                        <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                                        </div>
                                        <!-- /.direct-chat-infos -->
                                        <img class="direct-chat-img" src="/storage/profile-photos/AHZbjimcmqUXXEgIpc40kOSUlSh7Ugbfa6YgHOWv.png" alt="Message User Image">
                                        <div class="direct-chat-text">
                                        You better believe it!
                                        </div>
                                    </div>
                                    </div>
                                    <div class="direct-chat-contacts">
                                        <ul class="contacts-list">
                                            <li>
                                            <a href="#">
                                                <img class="contacts-list-img" src="/storage/profile-photos/AHZbjimcmqUXXEgIpc40kOSUlSh7Ugbfa6YgHOWv.png" alt="User Avatar">

                                                <div class="contacts-list-info">
                                                <span class="contacts-list-name">
                                                    Count Dracula
                                                    <small class="contacts-list-date float-right">2/28/2015</small>
                                                </span>
                                                <span class="contacts-list-msg">How have you been? I was...</span>
                                                </div>
                                            </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <form action="#" method="post">
                                        <div class="input-group">
                                            <textarea type="text" name="message" placeholder="Напишіть повідомлення ..." class="form-control"></textarea>
                                            <span class="input-group-append">
                                            <button type="submit" class="btn btn-warning">Відправити</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sidebar">
                <div class="widget about-course">
                    <h3>Інформація</h3>
                    <ul>
                        <li class="flex"><span>Автор:</span><span style="color: #333;"><a href="#"><?php echo App\Models\User::find($course->author)->name; ?></a></span></li>    
                        <li class="flex"><span>Уроків:</span><span style="color: #333;">{{ $lessonsCount }}</span></li>
                        <li class="flex"><span>Тривалість:</span><span style="color: #333;">{{ $course['duration'] }}</span></li>
                        <li class="flex"><span>Мова:</span><span style="color: #333;">українська</span></li>
                    </ul>
                </div>
                <div class="widget course-participants">
                    <h3>Учасники курсу</h3>
                    @if(count($subscribes) > 0)
                    <ul class="flex flex-l">
                        @foreach($subscribes as $subscribe)
                            @if( $subscribe->id != Auth::id() )
                            <li>
                                <a href="#chat" class="flex cover fancybox" attr-user-id="{{  $subscribe->id }}" attr-user-avatar="/storage/{{ $subscribe->profile_photo_path }}">
                                @if ( $subscribe->profile_photo_path )
                                    <img src="/storage/{{ $subscribe->profile_photo_path }}" class="img-circle elevation-2" alt="{{  $subscribe->name }}">
                                @else
                                    <img src="/images/user-default.png" alt="{{  $subscribe->name }}">
                                @endif   
                                
                                </a>
                                <p>{{ $subscribe->name }}</p>   
                            </li>
                            @endif
                        @endforeach
                    </ul>
                        @if(count($subscribes) > 7)
                        <div class="all-participants"><a href="#all-course-participants" class="fancybox">Всі учасники курсу</a></div>
                        <div id="all-course-participants" class="all-course-participants-window">
                            <h3>Учасники даного курсу</h3>
                            <ul class="flex flex-l">
                                @foreach($subscribes as $subscribe)
                                    @if( $subscribe->id != Auth::id() )
                                    <li>
                                        <a href="#chat" class="flex cover fancybox" attr-user-id="{{  $subscribe->id }}" attr-user-avatar="/storage/{{ $subscribe->profile_photo_path }}">
                                        @if ( $subscribe->profile_photo_path )
                                            <img src="/storage/{{ $subscribe->profile_photo_path }}" class="img-circle elevation-2" alt="{{  $subscribe->name }}">
                                        @else
                                            <img src="/images/user-default.png" alt="{{ $subscribe->name }}">
                                        @endif
                                            
                                        </a>
                                        <p>{{ $subscribe->name }}</p>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    @else
                    <p>На даний курс немає більше підписників</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="chat chat-popup-window" id="chat" style="display: none;">
	<div class="card card-warning direct-chat direct-chat-warning shadow">
		<div class="card-header">
			<h3 class="card-title">Чат з учасником курсу</h3>
			<div class="card-tools">
				 <button class="btn btn-tool" data-card-widget="collapse" type="button"><i class="fas fa-minus"></i></button> 
				<button class="btn btn-tool" data-widget="chat-pane-toggle" title="Contacts" type="button"><i class="fas fa-comments"></i></button> 
				<button class="btn btn-tool" data-card-widget="remove" type="button"><i class="fas fa-times"></i></button>
			</div>
		</div>
		<div class="card-body">
			<div class="direct-chat-messages">
				<div class="direct-chat-msg">
					<div class="direct-chat-infos clearfix">
						<span class="direct-chat-name float-left">Alexander Pierce</span> <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
					</div>
					<img alt="Message User Image" class="direct-chat-img" src="/storage/profile-photos/AHZbjimcmqUXXEgIpc40kOSUlSh7Ugbfa6YgHOWv.png"> 
					<div class="direct-chat-text">
						Is this template really for free? That's unbelievable!
					</div>
				</div>
				<div class="direct-chat-msg right">
					<div class="direct-chat-infos clearfix">
						<span class="direct-chat-name float-right">Sarah Bullock</span> <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
					</div>
					<img alt="Message User Image" class="direct-chat-img" src="/storage/profile-photos/AHZbjimcmqUXXEgIpc40kOSUlSh7Ugbfa6YgHOWv.png">
					<div class="direct-chat-text">
						You better believe it!
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<form action="#" method="get" name="chatform">
				<div class="input-group">
					<input class="form-control" name="message" placeholder="Напишіть повідомлення..." type="text">
                    <input type="hidden" name="userid" value="">
                    <input type="hidden" name="username" value="{{ Auth::user()->name }}">
                    <input type="hidden" name="myuserid" value="{{ Auth::id() }}">
                    <input type="hidden" name="myavatar" value="/storage/{{ Auth::user()->profile_photo_path }}">
                    <input type="hidden" name="useravatar" value="">
                    <span class="input-group-append">
					    <button class="btn btn-warning" type="submit"><span class="input-group-append">Відправити</span></button>
                    </span>
				</div>
			</form>
            <div id="status" style="display: none;"></div>
		</div>
	</div>
</div>
<style>
    .home {
        padding-top: 114px;
    }
</style>