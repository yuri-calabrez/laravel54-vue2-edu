<?php

namespace SON\Http\Controllers\Api\Student;

use Illuminate\Http\Request;
use SON\Http\Controllers\Controller;
use SON\Http\Requests\StudentClassTestRequest;
use SON\Models\ClassTest;
use SON\Models\StudentClassTest;

class StudentClassTestsController extends Controller
{
    public function show(ClassTest $classTest)
    {

    }

    public function store(StudentClassTestRequest $request, ClassTest $classTest)
    {
        $studentClassTest = StudentClassTest::createFully($request->input()+[
                'student_id' => \Auth::user()->userable->id
            ]);

        return $studentClassTest;
    }
}
