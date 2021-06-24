<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use  App\Models\Lesson;
use  App\Models\User;

class Course extends Model
{
    use HasFactory;

    public function lessons () {
        return $this->hasMany(Lesson::class, 'course_id', 'id');
    }
    public function users() {
        return $this->belongsToMany('App\Models\User', 'subscribes', 'course_id', 'user_id');
    }
}
