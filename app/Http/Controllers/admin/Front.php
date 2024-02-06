<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OurWork;
use Illuminate\Support\Facades\DB;
class Front extends Controller
{
    public function index(){
        $ourWork = OurWork::all();
        $ourWorkCats = DB::select("SELECT * FROM `workcategorties`");

        
        return view('admin.ourWork.create', compact('ourWork', 'ourWorkCats'));
    }

}