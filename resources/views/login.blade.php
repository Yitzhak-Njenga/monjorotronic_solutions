<!DOCTYPE html>
<html>
<head>
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        form {border: 3px solid #f1f1f1;}

        input[type=text], input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: rgb(255, 164, 0);
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
        }

        .cancelbtn {
            width: auto;
            padding: 10px 18px;
            background-color: #f44336;
        }

        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;
        }

        img.avatar {
            width: 40%;
            border-radius: 50%;
        }

        .container {
            padding: 26px;
        }

        span.psw {
            float: right;
            padding-top: 16px;
            padding-bottom: 16px;
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }
            .cancelbtn {
                width: 100%;
            }
        }

    </style>
</head>
<body>


<form action="/login" method="post" >
    @csrf
    <div class="imgcontainer">
        <img width="200px" src="/images/logo.png">
    </div>

    <div style="background-color: #2d3748" class="container col-6">
        <label class="text-center" for="uname"><b class="text-center text-white">Email</b></label>
        <input type="text"  placeholder="Enter Email" name="email" required>

        <label class="text-center" for="psw"><b class="text-center text-white">Password</b></label>
        <input type="password"  placeholder="Enter Password" name="password" required>

        <button type="submit">Login</button>

    </div>


</form>

@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
</body>
</html>
