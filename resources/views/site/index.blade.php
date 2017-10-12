<!doctype html>
<html>
    <head>
        <meta charset="utf-8">  
        <title>Employee Directory</title>
        <link href="{{asset('/css/bootstrap.css')}}" rel="stylesheet">
        <link href="{{asset('/css/cover.css')}}" rel="stylesheet">
        <link href="{{asset('/css/tree.css')}}" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="inner">
                <h3 class="masthead-brand">Employee Directory</h3>
                <ul class="nav masthead-nav"> 
                    <li><a href="/admin/employees">Админка</a></li>
                </ul>
            </div>
            <br>
            {{ csrf_field() }}
            <ul id="tree">
                <li><a href="#">Employees tree</a> 
                    <ul>
                        {!!$emploees!!}
                    </ul>
                </li>
            </ul>
        </div>  
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="{{asset('/js/tree.js')}}"></script>
    </body>
</html>
