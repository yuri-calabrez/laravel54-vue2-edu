<?php

namespace SON\Http\Controllers\Api\Student;

use Illuminate\Http\Request;
use SON\Http\Controllers\Controller;

class ClassInformationsController extends Controller
{
    public function index()
    {
        $student = \Auth::user()->userable;
        $results = $student->classInformations;
        return $results;
    }

    public function show($id)
    {
        $student = \Auth::user()->userable;
        $result = $student->classInformations()->findOrFail($id);
        return $result;
    }
}
