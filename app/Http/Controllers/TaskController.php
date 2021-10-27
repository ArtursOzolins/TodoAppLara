<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{

    public function index()
    {
        return $tasks = 'task app';
    }

    public function createNewTask()
    {

    }

    public function putInDB()
    {

    }
}
