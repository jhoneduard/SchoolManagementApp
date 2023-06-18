<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="/img/x-icon" href="img/libro.jpg">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistema Notas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c3a6c2f3b7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href=" {{ asset('css/login.css')}} ">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container my-5">
        @include('flash-message')
    </div>
    <div class="modal-dialog text-center container-sm-md container-fluid">
        <div class="row justify-content-center ">
            <div class="col-sm-8 main-section">
                <div class="modal-content">
                    <div class="col-12 user-img ">
                        <img src="{{ asset('img/userStudent.png')}} " />
                    </div>

                    <form method="post" action="{{ route('login') }}" class="col-12">
                        @csrf
                        <h5 class="text-white">Login</h5>

                        <div class="form-group" id="user-group">

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                            </div>
                            @error('email')
                            <div class="alert alert-danger" role="alert">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>  {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group" id="contrasena-group">

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                            </div>
                            @error('password')
                            <div class="alert alert-danger" role="alert">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>  {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="btn-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt"></i> Ingresar
                            </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>
    <div class="footer footer-sm-md-lg-xl">
        <p class="bg-info text-white">
            <strong class="text-center">© Copyright <?php echo date("Y"); ?> Sistema de gestion de notas </strong>
        </p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
</body>

</html>