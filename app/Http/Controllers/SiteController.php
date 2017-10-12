<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use DB;

class SiteController extends Controller
{
    private function ShowEmployees($pid, $depth, $level = 0) {
        $result = '';
        $array = DB::select("Select * FROM `employees` WHERE pid=:pid",['pid'=>$pid]);
            foreach ($array as $value) {
                $result.='<li name="' . $value->id . '" >' . $value->position . '[' . $value->id . ']: ' . $value->full_name . ', salary: ' . $value->salary . ', start date: ' . $value->start_date;
                if ($level + 1 < $depth | $depth == 0) {
                    $employees = $this->ShowEmployees($value->id, $depth, $level + 1);
                    if ($employees)
                        $result.='<ul>' . $employees . '</ul>';
                } else {
                    $result.='<ul></ul>';
                }
                $result.='</li>';
            } 
        return $result;
    }
    
    public function index()
    {
        if(request()->has('id'))
            return $this->ShowEmployees(request('id'), 0);
            
        return view('site/index')->with(['emploees'=>$this->ShowEmployees(0, 2)]);
    }
    
}
