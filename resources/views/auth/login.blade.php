<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SGA-E</title>

    <link href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/vendors/css/vendor.bundle.base.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/images/favicon.ico') }}" rel="shortcut icon" />
</head>

<body>

    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light p-5 text-left">
                        <div class="brand-logo text-center">
                            <img src="{{ asset('assets/images/logo.png') }}">
                        </div>
                        <hr>
                        <h4>Olá. Seja bem vindo (a)!</h4>
                        <h6 class="font-weight-light">Para acessar o sistema preencha suas credenciais</h6>
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form class="pt-3" method="POST" action="{{ route('login.custom') }}">
                            @csrf
                            <div class="form-group">
                                <input class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" name="email" type="email" placeholder="Email / Usuário" required autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" name="password" type="password" placeholder="Password" required>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-gradient-primary btn-lg font-weight-medium auth-form-btn" type="submit">ACESSO</button>
                            </div>
                            <div class="d-flex justify-content-between align-items-center my-2">
                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input class="form-control form-check-input" name="remember" type="checkbox"> Permanecer Conectado </label>
                                </div>
                                <a class="auth-link text-black" href="{{ url('recuperar_senha') }}">Esqueceu a senha?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>

</body>

</html>
