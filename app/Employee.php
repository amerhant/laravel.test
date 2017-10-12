<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
/**
 * App\Employee
 *
 * @mixin \Eloquent
 */
class Employee extends Model {

    protected $fillable = ['pid','full_name','position','start_date','salary','type_img'];

}
