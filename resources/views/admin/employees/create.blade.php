<!doctype html>
<html>
    <head>
        <meta charset="utf-8">  
        <title>Employee Directory</title>
        <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
        <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css"> 
        <link href="{{asset('css/cover.css')}}" rel="stylesheet"> 
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="{{asset('js/preview_img.js')}}"></script>
    </head>
    <body>
        <br>
        <div class="container">  
            <div class="inner">
                <h3 class="masthead-brand">Создание сотрудника</h3>
                <ul class="nav masthead-nav">
                    <li><a href="/admin/employees">Админка</a></li>
                    <li><a href="/">Дерево</a></li>
                    <li><a href="{{ route('logout') }}">Выход</a></li>
                </ul>
            </div>
            <br>
            <br>
            <br>
            <form class="form-signin" role="form" method='POST' enctype="multipart/form-data" action = '/admin/employees'>
                <div class="row">
                    <div class="col-md-6">
                        <div class="errors">
                            @if(count($errors)>0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif 
                        </div>
                        {{ csrf_field() }}
                        <label for="pid">Chief ID:</label>
                        <input type="number" name='pid' value="{{old('pid')}}" class="form-control" placeholder="Chief ID" required>
                        <small id="pidHelp" class="form-text text-muted">Выберете существующего начальника (для выбора корневой позиции впишите 0).</small>
                        <br><label for="full_name">Full name:</label>
                        <input type="text" name='full_name' value="{{old('full_name')}}" class="form-control" placeholder="Full name" required>
                        <label for="position">Position:</label>
                        <input type="text" name='position' value="{{old('position')}}" class="form-control" placeholder="Position" required>
                        <label for="start_date">Start date:</label>
                        <input type="date" name='start_date' value="{{old('start_date')}}" class="form-control" placeholder="Start date" required>
                        <label for="salary">Salary:</label>
                        <input type="number" name='salary' value="{{old('salary')}}" class="form-control" placeholder="Salary" required>
                    </div>
                    <div class="col-md-6">
                        <br>
                        <center>
                            <div style="width: 270px; height: 250px;">
                                <img style="max-width: 100%; max-height: 100%; margin: 0 auto;" id="img" src="{{asset('uploads/images/no-photo.png')}}" alt="photo" />
                            </div>
                        </center>
                        <input type="file" id="load" class="form-control-file" name="image" aria-describedby="fileHelp">
                        <small id="fileHelp" class="form-text text-muted">Изображение JPG/GIF/PNG.</small>
                    </div>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Сохранить</button>
            </form>
        </div> 
        <br>
    </body>
</html>