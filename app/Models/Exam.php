<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','featured_img'];

    // protected $guarded = ['*'];

    public function subjects()
    {
        return $this->hasMany(Subject::class,'exam_id');
    }

    public function questions()
    {
        return $this->hasManyThrough(Question::class,ExamSubject::class,'exam_id','exams_subject_id');
    }

}
