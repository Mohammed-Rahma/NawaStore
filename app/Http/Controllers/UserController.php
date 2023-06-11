<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    function index($first , $last=null){
        return $first .''. $last;
    }
}
