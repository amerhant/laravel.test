<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employee;
use Image;
use File;
use Validator;
use DB;

class EmployeesResource extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $order = 'ASC';
        if (request()->has('sort')) {
            if (request('sort') == 'type_img')
                $order = 'DESC';
            $employees = \App\Employee::orderBy(request('sort'), $order)->paginate(15);
            $sort = request('sort');
        }
        else {
            $employees = \App\Employee::paginate(15);
            $sort = 'id';
        }

        return view('admin/employees/index')->with(['employees' => $employees, 'sort' => $sort]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin/employees/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        Validator::extend('valid_pid', function($attribute, $value, $parameters) {
            if ($value < 0)
                return false;

            if ($value == 0)
                return TRUE;

            $find = Employee::find($value);
            return $find;
        });

        $this->validate($request, [
            'pid' => 'valid_pid',
            'full_name' => 'required|max:50|min:3',
            'position' => 'required|max:30|min:3',
            'start_date' => 'required|date',
            'salary' => 'required',
            'image' => 'image',
        ]);

        $options = $request->only('pid', 'full_name', 'position', 'start_date', 'salary');
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $options['type_img'] = $img->getClientOriginalExtension();
        } else
            $options['type_img'] = '';
        $item = Employee::create($options);

        if ($item->type_img != '') {
            $filename = $item->id . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(270, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('/uploads/images/employees/full/' . $filename));
            Image::make($img)->resize(37, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('/uploads/images/employees/mini/' . $filename));
        }
        return redirect()->route('employees.index', ['page' => ceil(Employee::all()->count() / 15)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $item = Employee::find($id);
        return view('admin/employees/update')->with(['item' => $item]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $item = Employee::find($id);
        Validator::extend('valid_pid', function($attribute, $value, $parameters) {
            if ($value < 0)
                return false;

            if ($value == 0)
                return TRUE;
            
            if($value==$parameters[0])
                return false;

            if (!$this->checkPid($parameters[0], $value))
                return false;

            $find = Employee::find($value);
            return $find;
        });

        $this->validate($request, [
            'pid' => 'valid_pid:' . $item->id,
            'full_name' => 'required|max:50|min:3',
            'position' => 'required|max:30|min:3',
            'start_date' => 'required|date',
            'salary' => 'required',
            'image' => 'image',
        ]);

        $options = $request->only('pid', 'full_name', 'position', 'start_date', 'salary');
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $options['type_img'] = $img->getClientOriginalExtension();
            $filename = $item->id . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(270, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('/uploads/images/employees/full/' . $filename));
            Image::make($img)->resize(37, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('/uploads/images/employees/mini/' . $filename));
        } else
            $options['type_img'] = $item->type_img;

        $item->pid = $options['pid'];
        $item->full_name = $options['full_name'];
        $item->position = $options['position'];
        $item->start_date = $options['start_date'];
        $item->salary = $options['salary'];
        $item->type_img = $options['type_img'];
        $item->save();

        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $item = Employee::find($id);
        $list = Employee::where('pid', $item->id)->get();
        foreach ($list as $value) {
            $value->pid = $item->pid;
            $value->save();
        }
        $item->delete();
        File::delete(public_path('uploads/images/employees/full/' . $item->id . '.' . $item->type_img));
        File::delete(public_path('uploads/images/employees/mini/' . $item->id . '.' . $item->type_img));
        return redirect()->back();
    }

    private function checkPid($id, $newPid) {
        $array = DB::select("Select * FROM `employees` WHERE pid=:id", ['id' => $id]);
        foreach ($array as $value) {
            if ($value->id == $newPid | (!$this->checkPid($value->id, $newPid)))
                return false;
        }
        return true;
    }

}
