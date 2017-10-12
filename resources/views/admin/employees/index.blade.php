@extends('layouts.app')
@section('content')
<div class="container"> 
    <div class="row"> 
        <div id="employees">
            <table class="table table-striped">
                <tr>
                    <th><a href="employees/?sort=type_img" >Photo</a></th>
                    <th><a href="employees/?sort=id" >ID</a></th>
                    <th><a href="employees/?sort=pid" >Chief ID</a></th>
                    <th><a href="employees/?sort=full_name" >Full name</a></th>
                    <th><a href="employees/?sort=position" >Position</a></th>
                    <th><a href="employees/?sort=start_date" >Start date</a></th>
                    <th><a href="employees/?sort=salary" >Salary</a></th>
                    <th>Actions</th>
                </tr>
                @foreach ($employees as $employee)
                <?php
                if ($employee->type_img != '')
                    $photo = '<img src="/public/uploads/images/employees/mini/' . $employee->id . '.' . $employee->type_img . '" alt="img">';
                else
                    $photo = '<img src="/public/uploads/images/no-photo_mini.png" alt="no photo">';
                ?>
                <tr>
                    <td>{!!$photo!!}</td>
                    <td>{{$employee->id}}</td>
                    <td>{{$employee->pid}}</td>
                    <td>{{$employee->full_name}}</td>
                    <td>{{$employee->position}}</td>
                    <td>{{$employee->start_date}}</td>
                    <td>{{$employee->salary}}</td>
                    <td>
                <center>
                    <form style="float:right;" role="form" method="POST" action = "/admin/employees/{{$employee->id}}">
                        <input type="hidden" name="_method" value="DELETE"> 
                        {{ csrf_field() }}
                        <button class="btn btn-danger btn-sm" type="submit" name="submit">Del</button>
                    </form>
                </center>
                <a role="button" style="float:right;" class="btn btn-primary btn-sm" href="/admin/employees/{{$employee->id}}/edit">Edit</a>
                </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="row">
        <div id="pagination" class="col-md-10">
            {{ $employees->appends(array('sort' => $sort))->links() }}
        </div>
    </div>
</div>   
@endsection
