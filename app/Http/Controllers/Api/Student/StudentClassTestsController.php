<?php

namespace SON\Http\Controllers\Api\Student;

use Illuminate\Http\Request;
use SON\Http\Controllers\Controller;
use SON\Http\Requests\StudentClassTestRequest;
use SON\Models\ClassTest;
use SON\Models\StudentClassTest;

class StudentClassTestsController extends Controller
{
    public function show(ClassTest $classTest, $id)
    {
        if(!ClassTest::greatherDateAnd30Minutes($classTest->date_end)) {
           abort(403);
        }

        $result = StudentClassTest
            ::where('student_id', \Auth::user()->userable->id)
            ->findOrFail($id);

        return $result->toArray()+[
                'choices' => $result
                    ->choices
                    ->pluck('question_choice_id', 'question_id')
                    ->toArray()
            ];
    }

    public function store(StudentClassTestRequest $request, ClassTest $classTest)
    {
        //dd($request->input());
        $studentClassTest = StudentClassTest::createFully($request->input()+[
                'student_id' => \Auth::user()->userable->id
            ]);

        return $studentClassTest;
    }
}
