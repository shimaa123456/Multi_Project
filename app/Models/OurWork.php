<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OurWork extends Model
{
    use HasFactory;
    protected $table = 'workprojects';


    public function categories()
    {
        return $this->belongsToMany(
            DB::table('workcategorties')->getBindings(),
            'workcatproj',
            'projId',
            'catId'
        );
    }

}