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
    <link href="{{ asset('assets/images/favicon.ico') }}" rel="shortcut icon" />

    <!-- mdi-icons:css -->
    <link href="{{ asset('assets/components/css/materialdesignicons.min.css') }}" rel="stylesheet">

    <!-- default-style:css -->
    <link href="{{ asset('assets/components/css/style.css') }}" rel="stylesheet">

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
        <nav class="navbar default-layout-navbar col-lg-12 col-12 fixed-top d-flex flex-row p-0">
            <div class="navbar-brand-wrapper d-flex align-items-center justify-content-center text-center">
                <a class="navbar-brand brand-logo" href="{{ env('APP_URL') }}"><img src="{{ asset('assets/images/logo-mini.png') }}" alt="{{ env('APP_NAME') }}" /></a>
                <a class="navbar-brand brand-logo-mini" href="{{ env('APP_URL') }}"><img src="{{ asset('assets/images/logo-mini.png') }}" alt="{{ env('APP_NAME') }}" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch align-middle">
                <button class="navbar-toggler navbar-toggler align-self-center" data-toggle="minimize" type="button">
                    <span class="mdi mdi-menu"></span>
                </button>
                <div class="w-100 mt-3">
                    {{-- @dd(session()->all()) --}}
                    <form class="d-flex" action="/atualizar-obra" method="POST">

                        @csrf
                        <select class="{{ session()->get('usuario_vinculo')->id_nivel < 3 ? 'form-select select2' : '' }} form-control mr-2" id="novo_id" name="novo_id">
                            @if (session()->get('usuario_vinculo')->id_nivel <= 2) <option value="" {{ session()->get('obra')['id'] == null ? 'selected' : '' }}>PERFIL ADMINISTRADOR - TODAS</option>

                                @foreach ($obras_lista as $obra_lista)
                                <option value="{{ $obra_lista->id }}" {{ session()->get('obra')['id'] == $obra_lista->id ? 'selected' : '' }}>
                                    {{ $obra_lista->codigo_obra }} | {{ $obra_lista->razao_social }} | {{ $obra_lista->cnpj }}
                                </option>
                                @endforeach
                                @else
                                <option value="{{ session()->get('obra')->id }}" readonly>
                                    {{ session()->get('obra')->codigo_obra }} | {{ session()->get('obra')->razao_social }} | {{ session()->get('obra')->cnpj }}
                                </option>
                                @endif
                        </select>
                        <!-- <button class="btn btn-gradient-danger" type="submit">OK</button> -->
                    </form>
                </div>

                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item w-100">

                    </li>
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                            <div class="nav-profile-img">
                                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="image">
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
                        <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                            <i class="mdi mdi-email-outline"></i>
                            <span class="count-symbol bg-warning"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                            <h6 class="mb-0 p-3">Messages</h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img class="profile-pic" src="{{ asset('assets/images/faces/face4.jpg') }}" alt="image">
                                </div>
                                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject ellipsis font-weight-normal mb-1">Mark send you a message
                                    </h6>
                                    <p class="text-gray mb-0"> 1 Minutes ago </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img class="profile-pic" src="{{ asset('assets/images/faces/face2.jpg') }}" alt="image">
                                </div>
                                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject ellipsis font-weight-normal mb-1">Cregh send you a
                                        message</h6>
                                    <p class="text-gray mb-0"> 15 Minutes ago </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img class="profile-pic" src="{{ asset('assets/images/faces/face3.jpg') }}" alt="image">
                                </div>
                                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject ellipsis font-weight-normal mb-1">Profile picture
                                        updated
                                    </h6>
                                    <p class="text-gray mb-0"> 18 Minutes ago </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <h6 class="mb-0 p-3 text-center">4 new messages</h6>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" data-bs-toggle="dropdown" href="#">
                            <i class="mdi mdi-bell-outline"></i>
                            <span class="count-symbol bg-danger"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                            <h6 class="mb-0 p-3">Notificações</h6>
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
                            <h6 class="mb-0 p-3 text-center">See all notifications</h6>
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
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" data-toggle="offcanvas" type="button">
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
                        <a class="nav-link" href="#">
                            <div class="nav-profile-image">
                                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="profile">
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

                    @yield('content')

                </div>
                <!-- content-wrapper ends -->

                <footer class="footer">
                    <div class="container-fluid d-flex justify-content-between">
                        <span class="text-muted d-block text-sm-start d-sm-inline-block text-center">{{ env('APP_COPY') }}</span>
                        <span class="float-sm-end mt-sm-0 float-none mt-1 text-end">{{ env('APP_COPY_DEVELOPMENT') }}</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    <!-- jquery:js-3.1.1 -->
    <script src="{{ asset('assets/components/js/jquery.min.js') }}?v=@php echo date('his'); @endphp"></script>

    <!-- bootstrap:js-4.1.3 -->
    <script src="{{ asset('assets/components/js/bootstrap.min.js') }}?v=@php echo date('his'); @endphp"></script>

    <!-- popper:js -->
    <script src="{{ asset('assets/components/js/popper.min.js') }}?v=@php echo date('his'); @endphp"></script>

    <!-- plugins:js -->
    <script src="{{ asset('assets/components/js/vendor.bundle.base.js') }}?v=@php echo date('his'); @endphp"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/components/js/Chart.min.js') }}?v=@php echo date('his'); @endphp"></script>
    <script src="{{ asset('assets/components/js/jquery.cookie.js') }}?v=@php echo date('his'); @endphp"></script>
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="{{ asset('assets/components/js/off-canvas.js') }}?v=@php echo date('his'); @endphp"></script>
    <script src="{{ asset('assets/components/js/hoverable-collapse.js') }}?v=@php echo date('his'); @endphp"></script>
    <script src="{{ asset('assets/components/js/misc.js') }}?v=@php echo date('his'); @endphp"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="{{ asset('assets/components/js/dashboard.js') }}?v=@php echo date('his'); @endphp"></script>
    <script src="{{ asset('assets/components/js/todolist.js') }}?v=@php echo date('his'); @endphp"></script>
    <!-- End custom js for this page -->

    <!-- inputmask:js -->
    <script src="{{ asset('assets/components/js/jquery.inputmask.min.js') }}?v=@php echo date('his'); @endphp"></script>

    <!-- summernote:css-js -->
    <link href="{{ asset('assets/components/css/summernote-bs4.min.css') }}?v=@php echo date('his'); @endphp" rel="stylesheet">
    <script src="{{ asset('assets/components/js/summernote-bs4.min.js') }}?v=@php echo date('his'); @endphp"></script>

    <!-- select2:js -->
    <script src="{{ asset('assets/components/js/select2.min.js') }}?v=@php echo date('his'); @endphp"></script>

    <!-- datatables:js -->
    <script src="{{ asset('assets/components/js/datatables.min.js') }}?v=@php echo date('his'); @endphp"></script>

    <!-- toastr:js -->
    <script src="{{ asset('assets/components/js/toastr.min.js') }}?v=@php echo date('his'); @endphp"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bs-custom-file-input/1.3.4/bs-custom-file-input.min.js?v=@php echo date('his'); @endphp"></script>

    <script>
        dados1 = {};
        BASE_URL = '<?php echo route('admin'); ?>';
        var route = window.location.pathname;


        /** Novo ID para o perfil Administrador */
        $("#novo_id").on('change', function() {

            novo_id = $(this).val();

            $.ajax({
                type: 'POST',
                url: "{{ route('atualizar.obra') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    novo_id: novo_id
                },
                success: function(result) {

                    $('.toastrDefaultSuccess').ready(function() {
                        toastr.success('Você fez login em outra obra!')
                    });

                    window.location.href = route;
                }
            })
        });


        $(document).ready(function() {
            $('#lista-simples').DataTable({
                order: [
                    [0, 'desc']
                ],
                language: {
                    search: 'Buscar',
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json',
                }
            });
        });

        $(document).ready(function() {
            $('#tabela').DataTable({
                "pageLength": 50,
                order: [
                    [0, 'desc']
                ],
                language: {
                    search: 'Buscar por ativo ',
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json',
                }
            });
        });

        $(document).ready(function() {
            $('#tabela-estoque').DataTable({
                pageLength: 50,
                order: [
                    [0, 'desc']
                ],
                paging: false,
                language: {
                    search: 'Buscar por ativo ',
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json',
                }
            });
        });

        $(".select2").select2();


        $(".ItemsRetirada").on('click', function() {
            let id_retirada = $(this).attr('data-id_retirada');


            $.ajax({
                type: 'GET',
                url: BASE_URL + '/ferramental/retirada/items/' + id_retirada,
                data: {},
                success: function(result) {
                    $(".modal-title").html('Itens da Retirada #' + id_retirada)
                    $(".modal-body").html(result)
                }
            });
        });

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
                                        url: BASE_URL +
                                            '/ferramental/retirada/termo_assinar/' +
                                            id_retirada,
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
                                                if (result
                                                    .isConfirmed) {
                                                    window.open(
                                                        BASE_URL +
                                                        '/ferramental/retirada/termo/' +
                                                        id_retirada);
                                                    hideModal(
                                                        "gerarTermoModal"
                                                    );
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



        $(document).on('blur', '#cep', function() {
            const cep = $(this).val();
            $.ajax({
                url: 'https://viacep.com.br/ws/' + cep + '/json/',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#estado').val(data.uf);
                    $('#cidade').val(data.localidade);
                    $('#bairro').val(data.bairro);
                    $('#endereco').val(data.logradouro);
                }
            });
        });

        $(document).on('blur', '#cnpj', function() {
            const cnpj = $(this).val();
            const numerosCnpj = cnpj.replace(/\D/g, '');

            $.ajax({
                url: 'https://publica.cnpj.ws/cnpj/' + numerosCnpj,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#razao_social').val(data.razao_social);
                    $('#nome_fantasia').val(data.estabelecimento.nome_fantasia);
                    $('#cep').val(data.estabelecimento.cep);
                    $('#endereco').val(data.estabelecimento.tipo_logradouro + ' ' + data.estabelecimento.logradouro);
                    $('#numero').val(data.estabelecimento.numero);
                    $('#bairro').val(data.estabelecimento.bairro);
                    $('#cidade').val(data.estabelecimento.cidade.nome);
                    $('#estado').val(data.estabelecimento.estado.sigla);
                    $('#email').val(data.estabelecimento.email);
                }
            });
        });


        // $(".selecionar_obra").on('change', function() {
        //     let id_obra = $(this).val();

        //     console.log('Selecionando Obra')

        //     $.ajax({
        //             url: "{{ route('api.selecionar_obra') }}",
        //             type: 'post',
        //             data: {
        //                 "_token": "{{ csrf_token() }}",
        //                 id_obra: id_obra,
        //                 route: route
        //             }
        //         })
        //         .done(function(msg) {
        //             window.location.href = route;
        //         })
        //         .fail(function(jqXHR, textStatus, msg) {
        //             alert(msg);
        //         });
        // })

        $('.summernote').summernote({
            height: 400
        });

        $('.select2-multiple').select2({
            minimumResultsForSearch: -1,
            placeholder: function() {
                $(this).data('placeholder');
            }
        });

        $('#obra').select2();

        $('#tipo').select2({
            minimumResultsForSearch: -1,
            placeholder: function() {
                $(this).data('placeholder');
            }
        });

        $('#marca').select2();

        $('#modelo').select2();

        $('#ano').select2();

        $('#situacao').select2();

        $('#fornecedor').select2();

        $('#combustivel').select2();

        $('#servico').select2();
        $('.addItem').select2();


        $(".money").inputmask('currency', {
            "autoUnmask": true,
            radixPoint: ",",
            groupSeparator: ",",
            allowMinus: false,
            prefix: 'R$ ',
            digits: 2,
            digitsOptional: false,
            rightAlign: true,
            unmaskAsNumber: true
        });


        $('.celular').inputmask('(99) 99999-9999');
        $('.cpf').inputmask('999.999.999-99');
        $('.cep').inputmask('99999-999');
        $('.cnpj').inputmask('99.999.999/9999-99');
        $("#valor_fipe1").inputmask('currency', {
            "autoUnmask": true,
            radixPoint: ",",
            groupSeparator: ",",
            allowMinus: false,
            prefix: 'R$ ',
            digits: 2,
            digitsOptional: false,
            rightAlign: true,
            unmaskAsNumber: true
        });
        $("#valor_do_litro").inputmask('currency', {
            "autoUnmask": true,
            radixPoint: ",",
            groupSeparator: ",",
            allowMinus: false,
            prefix: 'R$ ',
            digits: 2,
            digitsOptional: false,
            rightAlign: true,
            unmaskAsNumber: true
        });
        $("#valor_total").inputmask('currency', {
            "autoUnmask": true,
            radixPoint: ",",
            groupSeparator: ",",
            allowMinus: false,
            prefix: 'R$ ',
            digits: 2,
            digitsOptional: false,
            rightAlign: true,
            unmaskAsNumber: true
        });
        $("#valor_do_servico").inputmask('currency', {
            "autoUnmask": true,
            radixPoint: ",",
            groupSeparator: ",",
            allowMinus: false,
            prefix: 'R$ ',
            digits: 2,
            digitsOptional: false,
            rightAlign: true,
            unmaskAsNumber: true
        });
        $("#valor").inputmask('currency', {
            "autoUnmask": true,
            radixPoint: ",",
            groupSeparator: ",",
            allowMinus: false,
            prefix: 'R$ ',
            suffix: '',
            digits: 2,
            decimalProtect: true,
            rightAlign: true,
            unmaskAsNumber: true
        });
        $("#valor_atual").inputmask('currency', {
            "autoUnmask": true,
            radixPoint: ",",
            groupSeparator: ",",
            allowMinus: false,
            prefix: 'R$ ',
            suffix: '',
            digits: 2,
            decimalProtect: true,
            rightAlign: true,
            unmaskAsNumber: true
        });




        /* Exclusão Padrão */
        $('.excluir-padrao').on('click', function() {
            let tabela = $(this).data('table');
            let modulo = $(this).data('module');
            let redirecionar = $(this).data('redirect');
            let id = $(this).data('id');

            console.log(tabela, modulo, redirecionar, id)

        });

        $(document).on('click', '.remove', function() {
            $(this).closest('.item-lista').remove();
        });

        // $("#placa").inputmask({
        //     mask: 'AAA-9*99'
        // });


        $(document).ready(function() {
            $("#placa").on("blur", function() {
                var numero = $(this).val();
                var numeroFormatado = formatarNumero(numero);
                $(this).val(numeroFormatado);
            });
        });

        function formatarNumero(numero) {
            if (numero.length === 7) {
                var quintoCaractere = numero.charAt(4);
                if (isNaN(quintoCaractere)) {
                    return numero.slice(0, 3) + " " + numero.slice(3);
                } else {
                    return numero.slice(0, 3) + "-" + numero.slice(3);
                }
            } else {
                return numero; // Não aplicar formatação se o número não tiver o comprimento esperado
            }
        }












        /** Listagem de Ativos - Requisição */

        $(".listar-ativos").select2({
            tags: true,
            multiple: false,
            tokenSeparators: [",", " "],
            minimumInputLength: 2,
            minimumResultsForSearch: 10,
            ajax: {
                url: BASE_URL + '/ferramental/requisicao/lista_ativo',
                dataType: "json",
                type: "get",
                data: function(params) {
                    var queryParameters = {
                        term: params.term,
                    };
                    return queryParameters;
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.titulo + ' - Em Estoque: ' + item.quantidade_estoque,
                                id: item.id,
                            };
                        }),
                    };
                },
            },
        });

        $('.listar-ativos-remover').on("click", function() {
            $(".template-row:last").remove();
        });

        $('.listar-ativos-adicionar').click(function() {
            $('#listar-ativos-linha').append($('#listar-ativos-template').html());
            $(".template:last").select2();
            // $(".listar-ativos.template:last").select2({
            //     tags: true,
            //     multiple: false,
            //     tokenSeparators: [",", " "],
            //     minimumInputLength: 2,
            //     minimumResultsForSearch: 10,
            //     ajax: {
            //         url: BASE_URL + '/ferramental/requisicao/lista_ativo',
            //         dataType: "json",
            //         type: "get",
            //         data: function(params) {
            //             var queryParameters = {
            //                 term: params.term,
            //             };
            //             return queryParameters;
            //         },
            //         processResults: function(data) {
            //             return {
            //                 results: $.map(data, function(item) {
            //                     return {
            //                         text: item.titulo + ' - Em Estoque: ' + item
            //                             .quantidade_estoque,
            //                         id: item.id,
            //                     };
            //                 }),
            //             };
            //         },
            //     },
            // });



        });


        $(document).on('change', '.listar-ativos', function() {
            console.log($(this).val());
            alvo = $(this);

            $.ajax({
                    url: "{{ route('ferramental.requisicao.ativo_externo_id') }}/" + $(this).val(),
                    type: 'get',
                    data: {
                        "_token": "{{ csrf_token() }}",
                    }
                })
                .done(function(quantidade) {
                    console.log("Resultado", quantidade);
                    alvo.parent().parent().find(".text_quantidade").val(1);
                    alvo.parent().parent().find(".text_quantidade").prop('disabled', false);
                    alvo.parent().parent().find(".text_quantidade").attr('max', quantidade);
                })
                .fail(function(jqXHR, textStatus, quantidade) {
                    alert(quantidade);
                });

        });



        // EXIBIÇÃO DOS ALERTAS
        @if(Session::get('fail'))
        $('.toastrDefaultError').ready(function() {
            toastr.error('{{ Session::get("fail") }}')
        });
        @endif

        @if(Session::get('success'))
        $('.toastrDefaultSuccess').ready(function() {
            toastr.success('{{ Session::get("success") }}')
        });
        @endif

        // MODAL ATIVOS INTERNOS MARCAS
        $(function() {
            $(document).on('submit', '#marcas-form', function(e) {
                e.preventDefault();
                var marca = $("#marcas_modal").val();
                var _token = $("#_token_modal").val();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('ativo.interno.marcas.ajax') }}",
                    dataType: 'json',
                    data: {
                        '_token': _token,
                        'marca': marca
                    },
                    success: function(response) {
                        $('#marca').append('<option value="' + marca + '" selected="selected">' + marca + '</option>');
                        $('#modal-marcas').hide();
                        $('.modal-backdrop').hide();
                        $('#marcas-form').trigger("reset");
                    }
                });
            });

            $(document).on('submit', '#addMarcaModal', function(e) {
                e.preventDefault();
                var marca = $("#add_marca_da_maquina").val();
                var _token = $("#_token_modal").val();

                $.ajax({
                    type: 'POST',
                    url: '{{ route("ativo.veiculo.marcas.ajax") }}',
                    dataType: 'json',
                    data: {
                        '_token': _token,
                        'marca': marca
                    },
                    success: function(response) {
                        $('#marca_da_maquina').append('<option value="' + marca + '" selected="selected">' + marca + '</option>');
                        $('#addMarcaModal').hide();
                        $('.modal-backdrop').hide();
                        $('#addMarcaModal').trigger("reset");
                    }
                });
            });

            $(document).on('submit', '#servicos-form', function(e) {
                e.preventDefault();
                var name = $("#servicos_modal").val();
                var _token = $("#_token_modal").val();

                $.ajax({
                    type: 'POST',
                    url: '{{ route("ativo.veiculo.manutencao.servico.ajax") }}',
                    dataType: 'json',
                    data: {
                        '_token': _token,
                        'name': name
                    },
                    success: function(response) {
                        var servico_id = response.servico_id;
                        var servico = response.servico;
                        $('#servico_id').append('<option value="' + servico_id + '" selected="selected">' + servico + '</option>');
                        $('#modal-servicos').hide();
                        $('.modal-backdrop').hide();
                        $('#servicos-form').trigger("reset");
                    }
                });
            });

            $(document).on('submit', '#funcao-form', function(e) {
                e.preventDefault();
                var funcao = $("#funcao_modal").val();
                var codigo = $("#codigo_modal").val();
                var _token = $("#_token_modal").val();

                $.ajax({
                    type: 'POST',
                    url: '{{ route("cadastro.funcionario.funcoes.ajax") }}',
                    dataType: 'json',
                    data: {
                        '_token': _token,
                        'funcao': funcao,
                        'codigo': codigo
                    },
                    success: function(response) {
                        var funcao_id = response.funcao_id;
                        var funcao = response.funcao;
                        var codigo = response.codigo;
                        $('#id_funcao').append('<option value="' + funcao_id + '" selected="selected">' + codigo + ' | ' + funcao + '</option>');
                        $('#modal-funcao').hide();
                        $('.modal-backdrop').hide();
                        $('#funcao-form').trigger("reset");
                    }
                });
            });

            $('#file-form').on('submit', function() {
                $('#modal-file').hide();
                $('.modal-backdrop').hide();
                $('#marcas-file').trigger("reset");
            });

            bsCustomFileInput.init();

        });
    </script>

</body>

</html>