<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class web_timesheetController extends Controller
{
    public function index(){
        return view("Pages.role_officer.timesheet.index");
    }
}
