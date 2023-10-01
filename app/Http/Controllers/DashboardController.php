<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth'])->only('index');
    }
    public function index()
    {
        
        $name = "ahmed";
        return view("dashboard.index",compact('name'));
    }
}
