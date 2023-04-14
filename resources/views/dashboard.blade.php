<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SGA-E | @if (View::hasSection('title'))
        @yield('title')
        @else
        Dashboard
        @endif
    </title>

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />

    <!-- mdi-icons:css -->
    <link rel="stylesheet" href="{{ asset('assets/components/css/materialdesignicons.min.css') }}">

    <!-- default-style:css -->
    <link rel="stylesheet" href="{{ asset('assets/components/css/style.css') }}">

    <!-- bootstrap:css-4.1.3 -->
    <link href="{{ asset('assets/components/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- select2:css -->
    <link href="{{ asset('assets/components/css/select2.min.css') }}" rel="stylesheet" />

    <!-- datatables:css -->
    <link href="{{ asset('assets/components/css/datatables.min.css') }}" rel="stylesheet" />

    <!-- toastr:css -->
    <link href="{{ asset('assets/components/css/toastr.min.css') }}" rel="stylesheet" />

</head>

<body>
    <div class="container-scroller">

        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="{{ env('APP_URL') }}"><img src="{{ asset('assets/images/logo-mini.png') }}" alt="{{ env('APP_NAME') }}" /></a>
                <a class="navbar-brand brand-logo-mini" href="{{ env('APP_URL') }}"><img src="{{ asset('assets/images/logo-mini.png') }}" alt="{{ env('APP_NAME') }}" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>


                <div class="search-field d-none d-md-block">
                    <form class="d-flex align-items-center h-100" action="#">
                        <div class="input-group">
                            @if(Session::get('usuario_vinculo')['id_nivel'] == 2)
                            @csrf

                            <select class="select2 selecionar_obra">

                                @if(Session::has('obra') && !Session::get('usuario_vinculo')['id_obra'])
                                <option value="">Administrador - Todas as Obras</option>
                                @endif

                                @foreach($obras_lista as $obra)

                                <option value="{{ $obra->id }}" @if(Session::get('obra')['id']==$obra->id) selected="selected" @endif>
                                    {{ $obra->codigo_obra . ' - ' . $obra->razao_social }}
                                </option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                    </form>
                </div>





                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="nav-profile-img">
                                <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="image">
                                <span class="availability-status online"></span>
                            </div>
                            <div class="nav-profile-text">
                                <p class="mb-1 text-black">{{ Auth::user()->name }}</p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="mdi mdi-cached me-2 text-success"></i> Activity Log </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('signout') }}">
                                <i class="mdi mdi-logout me-2 text-primary"></i> Sair do Sistema </a>
                        </div>
                    </li>
                    <li class="nav-item d-none d-lg-block full-screen-link">
                        <a class="nav-link">
                            <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-email-outline"></i>
                            <span class="count-symbol bg-warning"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                            <h6 class="p-3 mb-0">Messages</h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="{{ asset('assets/images/faces/face4.jpg') }}" alt="image" class="profile-pic">
                                </div>
                                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message
                                    </h6>
                                    <p class="text-gray mb-0"> 1 Minutes ago </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="{{ asset('assets/images/faces/face2.jpg') }}" alt="image" class="profile-pic">
                                </div>
                                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a
                                        message</h6>
                                    <p class="text-gray mb-0"> 15 Minutes ago </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="{{ asset('assets/images/faces/face3.jpg') }}" alt="image" class="profile-pic">
                                </div>
                                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture
                                        updated
                                    </h6>
                                    <p class="text-gray mb-0"> 18 Minutes ago </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <h6 class="p-3 mb-0 text-center">4 new messages</h6>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                            <i class="mdi mdi-bell-outline"></i>
                            <span class="count-symbol bg-danger"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                            <h6 class="p-3 mb-0">Notificações</h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-success">
                                        <i class="mdi mdi-calendar"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                                    <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today
                                    </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-warning">
                                        <i class="mdi mdi-settings"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
                                    <p class="text-gray ellipsis mb-0"> Update dashboard </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-info">
                                        <i class="mdi mdi-link-variant"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                                    <p class="text-gray ellipsis mb-0"> New admin wow! </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <h6 class="p-3 mb-0 text-center">See all notifications</h6>
                        </div>
                    </li>
                    <li class="nav-item nav-logout d-none d-lg-block">
                        <a class="nav-link" href="#">
                            <i class="mdi mdi-power"></i>
                        </a>
                    </li>
                    <li class="nav-item nav-settings d-none d-lg-block">
                        <a class="nav-link" href="#">
                            <i class="mdi mdi-format-line-spacing"></i>
                        </a>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-profile">
                        <a href="#" class="nav-link">
                            <div class="nav-profile-image">
                                <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile">
                                <span class="login-status online"></span>
                                <!--change to offline or busy as needed-->
                            </div>
                            <div class="nav-profile-text d-flex flex-column">
                                <span class="font-weight-bold mb-2">{{ Auth::user()->name }}</span>
                                <span class="text-secondary text-small">{{ Auth::user()->email }}</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <span class="menu-title">Dashboard</span>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                    </li>

                    @foreach ($modulos_permitidos as $module)
                    <li class="nav-item">

                        @if (count($module['submodulo']) > 0)
                        <a class="nav-link" data-bs-toggle="collapse" href="#{{ $module['url_amigavel'] }}" aria-expanded="false" aria-controls="{{ $module['url_amigavel'] }}">
                            <span class="menu-title">{{ $module['titulo'] }}</span>
                            <i class="menu-arrow"></i>
                            <i class="{{ $module['icone'] }} menu-icon"></i>
                        </a>
                        @else
                        <a class="nav-link" href="{{ env('URL_APP_ADMIN') }}{{ $module['url_amigavel'] }}">
                            <span class="menu-title">{{ $module['titulo'] }}</span>
                            <i class="{{ $module['icone'] }} menu-icon"></i>
                        </a>
                        @endif

                        @if (count($module['submodulo']) > 0)
                        <div class="collapse" id="{{ $module['url_amigavel'] }}">
                            <ul class="nav flex-column sub-menu">
                                @foreach ($module['submodulo'] as $sub)
                                <?php
                                $item = env('URL_APP_ADMIN') . Request::segment(2) . '/' . Request::segment(3);

                                ?>
                                <li class="nav-item"> <a class="nav-link {{ $item === $sub['url_amigavel'] ? 'active-submodulo' : '' }}" href="{{ url($sub['url_amigavel']) }}">{{ $sub['titulo'] }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </li>
                    @endforeach

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('signout') }}">
                            <span class="menu-title">Sair do Sistema</span>
                            <i class="mdi mdi-power menu-icon"></i>
                        </a>
                    </li>

                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">


                <div class="content-wrapper">
                    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
                    @include('sweetalert::alert')
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->


                <footer class="footer">
                    <div class="container-fluid d-flex justify-content-between">
                        <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">{{ env('APP_COPY') }}</span>
                        <span class="float-none float-sm-end mt-1 mt-sm-0 text-end">{{ env('APP_COPY_DEVELOPMENT') }}</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    <!-- jquery:js-3.1.1 -->
    <script src="{{ asset('assets/components/js/jquery.min.js') }}"></script>

    <!-- bootstrap:js-4.1.3 -->
    <script src="{{ asset('assets/components/js/bootstrap.min.js') }}"></script>

    <!-- popper:js -->
    <script src="{{ asset('assets/components/js/popper.min.js') }}"></script>

    <!-- plugins:js -->
    <script src="{{ asset('assets/components/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/components/js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/components/js/jquery.cookie.js') }}"></script>
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="{{ asset('assets/components/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/components/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/components/js/misc.js') }}"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="{{ asset('assets/components/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/components/js/todolist.js') }}"></script>
    <!-- End custom js for this page -->

    <!-- inputmask:js -->
    <script src="{{ asset('assets/components/js/jquery.inputmask.min.js') }}"></script>

    <!-- summernote:css-js -->
    <link href="{{ asset('assets/components/css/summernote-bs4.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/components/js/summernote-bs4.min.js') }}"></script>

    <!-- select2:js -->
    <script src="{{ asset('assets/components/js/select2.min.js') }}"></script>

    <!-- datatables:js -->
    <script src="{{ asset('assets/components/js/datatables.min.js') }}"></script>

    <!-- toastr:js -->
    <script src="{{ asset('assets/components/js/toastr.min.js') }}"></script>

    <script>
        dados1 = {};
        BASE_URL = '<?php echo route('admin'); ?>';
        var route = window.location.pathname;


        $(document).ready(function() {

            //toastr.error('Teste')



        });



        $(".select2").select2();

        console.log('Iniciando JQuery')


        //$(document).ready(function() {

        $("#gerar_termo").on('click', function() {

            $("#gerarTermoModal").show('fade');
            let id_retirada = $(this).attr('data-id_retirada');

            $(".retirada-assinar-termo").on('click', function(e) {

                let tipo = $(this).attr('data-tipo');


                console.log(tipo)

                if (tipo == 'manual') {
                    window.open(BASE_URL + '/ferramental/retirada/termo/' + id_retirada);
                    return location.reload();
                }

                if (tipo == 'digital') {

                    console.log('Autenticar Digitalmente')

                    Swal.fire({
                        title: 'Atenção!',
                        text: "Você está prestes a assinar um documento confidencial para liberação dos itens já descritos. Esta operação não poderá ser revertida.",
                        icon: 'warning',
                        footer: 'Em caso de dúvidas, entre em contato com seu gestor.',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Assinar Documento'
                    }).then((result) => {
                        if (result.isConfirmed) {

                            let timerInterval
                            Swal.fire({
                                title: 'Aguarde.',
                                html: 'Estamos autenticando o documento em <b></b> milisegundos.',
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()
                                    const b = Swal.getHtmlContainer()
                                        .querySelector('b')
                                    timerInterval = setInterval(() => {
                                        b.textContent = Swal
                                            .getTimerLeft()
                                    }, 100)
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                }
                            }).then((result) => {

                                if (result.dismiss === Swal.DismissReason
                                    .timer) {


                                    // salvar autenticidade
                                    $.ajax({
                                        type: 'GET',
                                        url: BASE_URL + '/ferramental/retirada/termo_assinar/' + id_retirada,
                                        data: {},
                                        success: function(result) {

                                            if (result == 0) {
                                                Swal.fire(
                                                    'Eita!',
                                                    'Algo deu errado na assinatura.',
                                                    'error'
                                                )
                                            }

                                            Swal.fire({
                                                title: 'Sucesso!',
                                                text: "O Termo de responsabilidade foi assinado com sucesso!",
                                                icon: 'success',
                                                showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                cancelButtonText: 'Fechar',
                                                confirmButtonText: 'Baixar Documento'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    window.open(BASE_URL + '/ferramental/retirada/termo/' + id_retirada);
                                                    hideModal("gerarTermoModal");
                                                }
                                            })
                                        }
                                    });
                                }
                            })
                        }
                    })
                }
            })
        })

        $(".digitar-manualmente").on('click', function() {
            let field = $(this).attr('data-field');
            console.log(field)
            if (this.checked) {
                $("#" + field).attr("readonly", false);
            } else {
                $("#" + field).attr("readonly", true);
            }
        })

        $(".cep").on('keyup', function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $("#cep").val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("//viacep.com.br/ws/" + cep + "/json/?callback=?", function(
                        dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#endereco").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#estado").val(dados.uf);
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            console.log("CEP não encontrado.");
                        }
                    });
                } //end if.
                else {
                    console.log("Formato de CEP inválido.");
                }
            } //end if.
        });

        $(".selecionar_obra").on('change', function() {
            let id_obra = $(this).val();

            console.log('Selecionando Obra')

            $.ajax({
                    url: "{{ route('api.selecionar_obra') }}",
                    type: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id_obra: id_obra,
                        route: route
                    }
                })
                .done(function(msg) {
                    window.location.href = route;
                })
                .fail(function(jqXHR, textStatus, msg) {
                    alert(msg);
                });
        })

        $('.summernote').summernote({
            height: 400
        });

        $('.select2-multiple').select2({
            minimumResultsForSearch: -1,
            placeholder: function() {
                $(this).data('placeholder');
            }
        });

        $(".money").inputmask({
            mask: "99-999-99"
        });

        $('.celular').inputmask('(99) 99999-9999');
        $('.cpf').inputmask('999.999.999-99');
        $('.cep').inputmask('99999-999');
        $('.cnpj').inputmask('99.999.999/9999-99');


        /* Exclusão Padrão */
        $('.excluir-padrao').on('click', function() {
            let tabela = $(this).data('table');
            let modulo = $(this).data('module');
            let redirecionar = $(this).data('redirect');
            let id = $(this).data('id');

            console.log(tabela, modulo, redirecionar, id)

        })

        $(document).on('click', '.remove', function() {
            $(this).closest('.item-lista').remove();
        })

        //});
    </script>

</body>

</html>