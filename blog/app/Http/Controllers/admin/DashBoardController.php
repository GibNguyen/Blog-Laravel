<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DashBoardController extends Controller
{
    //
    public function index(){
        return view('admin.dashboard');
    }

}
