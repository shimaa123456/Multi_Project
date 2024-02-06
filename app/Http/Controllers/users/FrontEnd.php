<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Mainbanner;

class FrontEnd extends Controller
{
    //
    public function index(){
        $mainBanner = Mainbanner::all();
        $ourWorkCats = DB::select("SELECT * FROM `workcategorties`");

        $ourWork = DB::select("SELECT `workprojects`.`title_en`, `workprojects`.`title_fr`,`workprojects`.`title_ar`,`workprojects`.`description_en`,`workprojects`.`description_fr`,`workprojects`.`description_ar`, `workprojects`.`photo`, GROUP_CONCAT(`workcategorties`.`categoryName` SEPARATOR ' ') AS `categories` FROM `workprojects`, `workcatproj`, `workcategorties` WHERE `workprojects`.`id` = `workcatproj`.`projId` AND `workcategorties`.`id` = `workcatproj`.`catId` GROUP BY `workprojects`.`id`;");

        return view('users.index', compact('mainBanner', 'ourWork', 'ourWorkCats'));

        /* return view('users.index', compact('mainBanner', '....', '....')); */
    }
}