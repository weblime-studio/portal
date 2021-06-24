@extends('layouts/layout')
<div class="course-page">
    <div class="inside">
        <div class="title"><span>Мої курси</span></div>
        <div class="list flex flex-s">
            
            @foreach($courses as $course)    
            <div class="item">
                <div class="overlay flex flex-c flex-m">
                    <div class="overlay-inner">
                        <div class="button"><a href="#">Отримати доступ</a></div>
                        <div class="button"><a href="#">Вхід</a></div>
                    </div>
                </div>
                <div class="item-inner">
                    <div class="image cover flex"><img src="{{ $course->preview }}" alt=""></div>
                    <div class="description">
                        <div class="category">{{ $course->category }}</div>
                        <div class="name">{{ $course->name }}</div>
                        <div class="desc">
                            <p>{{ $course->excerpt }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
</div>