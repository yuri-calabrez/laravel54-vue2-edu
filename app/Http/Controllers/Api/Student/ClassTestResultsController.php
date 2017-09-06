<?php

namespace SON\Http\Controllers\Api\Student;

use Carbon\Carbon;
use Illuminate\Http\Request;
use SON\Http\Controllers\Controller;

class ClassTestResultsController extends Controller
{
    public function perSubject(Request $request)
    {
        $sumClassTestsPoints = "(SELECT SUM(`point`) FROM questions WHERE questions.class_test_id = class_tests.id)";
        $selects = [
        'student_class_tests.created_at',
        "(student_class_tests.`point`/$sumClassTestsPoints)*100 AS percentage"
        ];

        $results = \DB::table('student_class_tests')
        ->selectRaw(implode(',', $selects))
        ->join('class_tests', 'class_tests.id', '=', 'student_class_tests.class_test_id')
        ->where('student_id', 48)
                //->where('student_id', 33)
                //->where('class_tests.class_teaching_id', 183)
        ->where('class_tests.class_teaching_id', 225)
        ->orderBy('student_class_tests.created_at', 'ASC')
        ->get();

        $results->map(function ($item){
            $item->created_at = (new Carbon($item->created_at))->format(Carbon::ISO8601);
            return $item;
        });
        return $results;
    }
}
