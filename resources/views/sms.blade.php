<?php
Use Illuminate\Support\Facades\Session;
?>
<html>
<head>
    <title>Bulk Sms</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <style>

        form{
            margin-top: 100px;
            width: 800px;
            margin-left: 400px;
            background-color: #e8d2a0;
            border-radius: 30px;
            padding: 20px;
        }

        input[type=text]{
            height: 100px;
        }
        input[type=file]{
            margin-bottom: 10px;
        }
        button{
            margin-top: 20px;
        }
        h1{
            text-align: center;
        }

    </style>
</head>
<body>
@if(Session::has('user'))
<form method="post" action="upload" enctype="multipart/form-data">

        <div class="container">
            <div class="row">
                <div class="col">
                    Hi, {{Session::get('user')['name']}}
                </div>
                <div class="col">

                </div>
                <div class="col">
                    <a href="/logout"><button type="button" class="btn btn-outline-success">Logout</button></a>
                </div>
            </div>
        </div>

    <h1>Bulk Sms System</h1>
    @csrf
    <input type="file" class="form-group" name="file">
    <div class="row">
        <input type="text" name="message" placeholder="type your message here">
    </div>
    <br>
    <button class="btn btn-danger col-12" type="submit">Send</button>
    @else
        <a href="/admin" class="btn-outline-danger">You are not an admin</a>
    @endif
</form>
</body>
</html>
