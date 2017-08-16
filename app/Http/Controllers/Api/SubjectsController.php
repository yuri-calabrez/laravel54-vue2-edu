<?php

namespace SON\Http\Controllers\Api;

use Illuminate\Http\Request;
use SON\Http\Controllers\Controller;
use SON\Models\Subject;

class SubjectsController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index(Request $request)
    {
        $search = $request->get('q');
        return !$search ? [] : Subject::where('name', 'LIKE', "%{$search}%")->get();
    }
}
