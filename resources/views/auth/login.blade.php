<!DOCTYPE html>
<html lang="en" class="body-full-height">

<head>
    <!-- META SECTION -->
    <title>Chalghuri Echo-Tourism</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <!-- END META SECTION -->

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="{{ url('public/css/theme-default.css') }}" />
    <!-- EOF CSS INCLUDE -->
</head>

<body>

    <div class="login-container">

        <div class="login-box animated fadeInDown">
            {{-- <div class="login-logo"></div> --}}
            <img src="upload/chalghuri_logo.png" style="height: 120px; width:399px;" alt="chalghuri">
            <div class="login-body">
                <div class="login-title"><strong>Log In</strong> to your account</div>
                <form action="" class="form-horizontal" method="post">
                    {{ csrf_field() }}
                    @include('_message')
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" class="form-control" required placeholder="E-mail" name="email" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" class="form-control" required placeholder="Password"
                                name="password" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <a href="#" class="btn btn-link btn-block">Forgot your password?</a>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-info btn-block">Log In</button>
                        </div>
                    </div>

                </form>
            </div>

        </div>

    </div>

</body>

</html>
