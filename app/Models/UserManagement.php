<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;




class UserManagement extends Model
{
    public function registerNewUser($data){
        DB::table('users')->insert($data);
    }

}
