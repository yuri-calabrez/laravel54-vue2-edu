<?php

namespace SON\Http\Controllers\Api;

use Illuminate\Http\Request;
use SON\Http\Controllers\Controller;
use SON\Models\Teacher;

class TeachersController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index(Request $request)
    {
        $search = $request->get('q');
        return !$search ? [] : Teacher::whereHas('user', function($query) use ($search){
            return $query->where('users.name', 'LIKE', "%{$search}%");
        })->take(10)->get();
    }
}
