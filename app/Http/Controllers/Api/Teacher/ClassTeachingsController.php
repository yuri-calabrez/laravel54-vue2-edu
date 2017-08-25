<?php

namespace SON\Http\Controllers\Api\Teacher;

use Illuminate\Http\Request;
use SON\Http\Controllers\Controller;
use SON\Models\ClassTeaching;

class ClassTeachingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = ClassTeaching::where('teacher_id', \Auth::user()->userable->id)->get()->toArray();

        return array_map(function($item){
            unset($item['teacher']);
            return $item;
        },$results);
    }


    /**
     * Display the specified resource.
     *
     * @param ClassTeaching $class_teaching
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(ClassTeaching $class_teaching)
    {
        $result = ClassTeaching::where('teacher_id', \Auth::user()->userable->id)
            ->findOrFail($class_teaching)
            ->toArray();
        unset($result['teacher']);
        return $result;
    }
}
