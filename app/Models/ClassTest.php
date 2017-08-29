<?php

namespace SON\Models;

use Illuminate\Database\Eloquent\Model;

class ClassTest extends Model
{
    protected $fillable = [
        'date_start',
        'date_end',
        'name',
        'class_teaching_id',
    ];

    public function classTeaching()
    {
        return $this->belongsTo(ClassTeaching::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function scopeByTeacher($query, $teacherId)
    {
        return $query->whereHas('classTeaching', function($query) use ($teacherId){
           $query->where('teacher_id', $teacherId);
        });
    }

    public static function createFully(array $data)
    {
        $classTest = self::create($data);
        foreach ($data['questions'] as $question) {
            self::createQuestion($question+['class_test_id' => $classTest->id]);
        }
        return $classTest;
    }

    public function updateFully(array $data)
    {
        $this->update($data);
        $this->deleteQuestions();
        foreach ($data['questions'] as $question) {
            self::createQuestion($question+['class_test_id' => $this->id]);
        }
        return $this;
    }

    public function deleteFully()
    {
        $this->deleteQuestions();
        $this->delete();
    }

    protected static function createQuestion($question)
    {
        $newQuestion = Question::create($question);
        foreach ($question['choices'] as $choice) {
            $newQuestion->choices()->create($choice);
        }
    }

    protected function deleteQuestions()
    {
        foreach ($this->questions()->get() as $question) {
            $question->choices()->delete();
            $question->delete();
        }
    }

    public function toArray()
    {
        $data = parent::toArray();
        $data['questions'] = $this->questions;
        return $data;
    }

}
