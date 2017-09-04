<?php

namespace SON\Http\Controllers\Api\Student;

use Illuminate\Http\Request;
use SON\Http\Controllers\Controller;
use SON\Models\ClassTeaching;
use SON\Models\ClassTest;

class ClassTestsController extends Controller
{
    public function index(ClassTeaching $classTeaching)
    {
        $results = ClassTest
            ::where('class_teaching_id', $classTeaching->id)
            ->byStudent(\Auth::user()->userable->id)
            ->get();
        return $results;
    }

    public function show(ClassTeaching $classTeaching, $id)
    {
        $result = ClassTest
            ::byStudent(\Auth::user()->userable->id)
            ->findOrFail($id);
        $array = $result->toArray();

        $array['questions'] = array_map(function($question){

            $question['choices'] = array_map(function($choice){
                unset($choice['true']);
                return $choice;
            }, $question['choices']->toArray());

            return $question;
        }, $result->questions->toArray());

        return $array;
    }
}
