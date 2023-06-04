@extends('dashboard')
@section('title', 'Dashboard')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary me-2 text-white">
                <i class="mdi mdi-home menu-icon"></i>
            </span> Dashboard
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>SGA - Sistema de Gestão de Ativos <i class="mdi mdi-check icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <div class="col-xl-9 col-sm-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="d-flex align-items-center mb-3">
                        <h3 class="m-0 pr-2"></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .weight-500 {
            font-weight: 500;
        }

        .height-100-p {
            height: 100%;
        }

        .bg-white {
            background: #ffffff;
        }

        .border-radius-10 {
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
        }

        .text-dark {
            color: #000000;
        }

        .font-30 {
            font-size: 30px;
            line-height: 1.46em;
        }

        .font-20 {
            font-size: 20px;
            line-height: 1.5em;
        }

        .box-shadow {
            -webkit-box-shadow: 0px 0px 28px rgba(0, 0, 0, .08);
            -moz-box-shadow: 0px 0px 28px rgba(0, 0, 0, .08);
            box-shadow: 0px 0px 28px rgba(0, 0, 0, .08);
        }

        .widget-style3 {
            padding: 30px 20px;
        }

        .widget-style3 .widget-data {
            width: calc(100% - 60px);
        }

        .widget-style3 .widget-icon {
            width: 60px;
            font-size: 45px;
            line-height: 1;
        }

        .gradient-style1 {
            background-image: linear-gradient(to right, #da8cff, #9a55ff) !important;
        }

        .gradient-style2 {
            background-image: linear-gradient(to right, #da8cff, #9a55ff) !important;
        }

        .gradient-style3 {
            background-image: linear-gradient(to right, #da8cff, #9a55ff) !important;
        }

        .gradient-style4 {
            background-image: linear-gradient(to right, #da8cff, #9a55ff) !important;
        }
    </style>

    <div class="row mb-5">
        {{-- <div class="col-xl-3 mb-50 mb-2">
            <div class="gradient-style1 box-shadow border-radius-10 height-100-p widget-style3 text-white">
                <div class="d-flex align-items-center flex-wrap">
                    <div class="widget-data">
                        <div class="weight-400 font-20">Empresas</div>
                        <div class="weight-300 font-30">{{ Estatistica::empresas() }}</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon"><i class="mdi mdi-home-city" aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-xl-3 mb-50 mb-2">
            <div class="gradient-style2 box-shadow border-radius-10 height-100-p widget-style3 text-white">
                <div class="d-flex align-items-center flex-wrap">
                    <div class="widget-data">
                        <div class="weight-400 font-20">Funcionários</div>
                        <div class="weight-300 font-30">{{ Estatistica::funcionarios() }}</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon"><i class="mdi mdi-account-group" aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-xl-3 mb-50 mb-2">
            <div class="gradient-style3 box-shadow border-radius-10 height-100-p widget-style3 text-white">
                <div class="d-flex align-items-center flex-wrap">
                    <div class="widget-data">
                        <div class="weight-400 font-20">Fornecedores</div>
                        <div class="weight-300 font-30">{{ Estatistica::fornecedores() }}</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon"><i class="mdi mdi-dolly" aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-xl-3 mb-50 mb-2">
            <div class="gradient-style4 box-shadow border-radius-10 height-100-p widget-style3 text-white">
                <div class="d-flex align-items-center flex-wrap">
                    <div class="widget-data">
                        <div class="weight-400 font-20">Obras</div>
                        <div class="weight-300 font-30">{{ Estatistica::obras() }}</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon"><i class="mdi mdi-hard-hat" aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-sm-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5>Finalizar cadastros ({{ Tarefa::countObras() }})</h5>
                    <table class="table-border table-responsive table">
                        @foreach (Tarefa::obras() as $obra)
                            <tr>
                                <td>
                                    {{ $obra->codigo_obra }} - {{ $obra->razao_social }}
                                </td>
                                <td style="width: 20%">
                                    <a href="{{ route('cadastro.obra.editar', $obra->id) }}"><span class="badge badge-success">Completar cadastro</span></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5>Funcionários bloqueados ({{ count(Tarefa::funcionariosBloqueados()) }})</h5>
                    <table class="table-border table-responsive table">
                        @foreach (Tarefa::funcionariosBloqueados() as $bloqueado)
                            <tr>
                                <td>
                                    {{ $bloqueado->funcionario->matricula }} - {{ $bloqueado->funcionario->nome }}
                                </td>
                                <td style="width: 20%">
                                    <a href="{{ route('cadastro.funcionario.editar', $bloqueado->funcionario->id) }}"><span class="badge badge-success">Visualizar dados de contato</span></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5>Aniversariantes do mês ({{ count(Estatistica::aniversariantes()) }})</h5>
                    <table class="table-border table-responsive table">
                        @foreach (Estatistica::aniversariantes() as $aniversariante)
                            <tr>
                                <td>
                                    {{ $aniversariante->matricula }} - {{ $aniversariante->nome }} | {{ Tratamento::dateBr($aniversariante->data_nascimento) }}
                                </td>
                                <td style="width: 20%">
                                    <a href="{{ route('cadastro.funcionario.editar', $aniversariante->id) }}"><span class="badge badge-success">Visualizar dados de contato</span></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-sm-12 mb-12">
            <div class="card">
                <div class="card-body">
                    <h5>Preventivas ({{ count(Tarefa::preventivas()) }})</h5>
                    <table class="table-border table">
                        @foreach (Tarefa::preventivas() as $preventiva)
                            <tr>
                                <td>
                                    {{ $preventiva->veiculo->marca }} | {{ $preventiva->veiculo->modelo }} | {{ $preventiva->veiculo->veiculo }}<br>
                                    {{ $preventiva->descricao }}
                                </td>
                                <td style="width: 20%">
                                    <a href="{{ route('ativo.veiculo.manutencao.editar', $preventiva->manutencao->id) }}"><span class="badge badge-success">Visualizar dados da manutenção</span></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
