<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use  App\Models\Course;

class Lesson extends Model {
    use HasFactory;

    public function lessonCourse () {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }
}
