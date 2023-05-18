@extends('app')
@section('title', 'Login')
@section('content')

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
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->

@endsection
