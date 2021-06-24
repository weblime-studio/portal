@extends('layouts/layout')

<div class="article-poster">
    <div class="inside">
        <div class="cat"><span>{{ $course->category }}</span></div>
        <div class="title">Курс: {{ $course['name'] }}</div>
    </div>    
</div>
<div class="article-detail course-{{ $course['id'] }}" >
    <div class="inside">
        <div class="flex flex-t">
            <div class="content">
                <h3>Опис курсу</h3>
                <div class="description">
                    {!! $course->description !!}
                </div>
                <div class="video youtube-video">
                    <div class="inline-relative">
                        <img src="/images/videoframe.jpg" alt="">
                        <iframe src="{{ $course->video }}"></iframe>
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
                        @if(count($subscribes) > 6)
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
<div class="course-page lessons">
    <div class="inside">
        <h3 class="title">Уроки курсу</h3>
        <div class="list flex flex-s">
            <?php $i = 1; ?>
            @foreach($lessons as $lesson)
                
                <div class="item locked {{ $i == 1 ? '' : 'locked' }}">
                    @if($i > 1)
                    <div class="overlay"></div>
                    @endif
                    <div class="item-inner">
                        <div class="image"><a href="/lesson/{{ $lesson->slug }}" class="image cover flex"><img src="/{{ $lesson->preview }}" alt=""></a></div>
                        <div class="description">
                            <div class="name"><a href="/lesson/{{ $lesson->slug }}">{{ $lesson->name }}</a></div>
                            <div class="desc">
                                {!! $lesson->excerpt !!}
                            </div>
                        </div>
                    </div>
                </div>
            <?php $i++; ?>
            @endforeach
            <div class="item hidden"></div>
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
				
			</div>
		</div>
		<div class="card-footer">
			<form action="#" method="get" class="chatform" name="chatform">
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


<!--<div id="chat" class="chat">
    <div class="card card-warning direct-chat direct-chat-warning">
        <div class="card-header">
        <h3 class="card-title">Direct Chat</h3>

        <div class="card-tools">
        
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
            <i class="fas fa-comments"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
            </button>
        </div>
        </div>
        
        <div class="card-body">       

            
            <div class="direct-chat-contacts" id="messages-field">
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
   
        <div class="card-footer">
            <form action="" name="messages">
                <div class="input-group">                    
                    <input type="hidden" name="fname" id="nameField" value="{{ Auth::user()->name }}" />
                    <input type="text" name="msg" id="textField" placeholder="Type Message ..." class="form-control">
                    <span class="input-group-append">
                        <button type="submit" class="btn btn-warning">Send</button>
                    </span>
                </div>
                <div id="status"></div>
            </form>
        </div>

    </div>
</div>
<div class="chat-place">
	<div class="info">
		<h1>Web Sockets!</h1>

		<form action="" name="messages">
			<div class="row">
				<label>Name: </label>
				<input type="text" id="nameField" autocomplete="off"  name="fname"/>
			</div>
			<div class="row">
				<label>Text: </label>
				<input type="text" id="textField" autocomplete="off" name="msg"/>
			</div>
			<div class="row"><input type="submit" value="go!"/></div>
		</form>
		<div id="status"></div>
	</div>

	<div id="messages-field">
		<div class="leftmessage">
			 
			
		</div>
	</div>
</div>-->
<style>
    .home {
        padding-top: 114px;
    }
</style>