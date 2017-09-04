<?php

namespace SON\Models;

use Illuminate\Database\Eloquent\Model;

class StudentClassTest extends Model
{
    protected $fillable = [
        'student_id',
        'question_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function choices()
    {
        return $this->hasMany(StudentQuestionChoice::class);
    }

    public function classTest()
    {
        return $this->belongsTo(ClassTest::class);
    }
}
