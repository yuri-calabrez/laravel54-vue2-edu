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
            ->ByStudent(\Auth::user()->userable->id)
            ->get();

        return $results;
    }

    public function show(ClassTeaching $classTeaching, $id)
    {
        $result = ClassTest
            ::ByStudent(\Auth::user()->userable->id)
            ->findOrFail($id);

        return $result;
    }
}
