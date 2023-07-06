<?php

namespace App\Http\Controllers\Beauty;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class beautymainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('admin.beauty.main.index');
    }


}
