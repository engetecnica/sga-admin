@extends('dashboard')
@section('title', 'Empresas')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary me-2 text-white">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span> Empresas
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Cadastros <i class="mdi mdi-check icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>

    <div class="page-header">
        <h3 class="page-title">
            @if (session()->get('usuario_vinculo')->id_nivel <= 2)
                <a href="{{ route('cadastro.empresa.adicionar') }}">
                    <button class="btn btn-sm btn-danger">Novo Registro</button>
                </a>
            @endif
        </h3>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <table class="table-hover table-striped table" id="lista-simples">
                        <thead>
                            <tr>
                                <th width="8%">ID</th>
                                <th>CNPJ</th>
                                <th>Razão Social</th>
                                <th>WhatsApp</th>
                                <th>E-mail</th>
                                <th>Status</th>
                                @if (session()->get('usuario_vinculo')->id_nivel <= 2)
                                    <th width="15%">Ações</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lista as $v)
                                <tr>
                                    <td><span class="badge badge-dark">{{ $v->id }}</span></td>
                                    <td>{{ $v->cnpj ?? '-' }}</td>
                                    <td>{{ $v->razao_social }}</td>
                                    <td>{{ $v->celular }}</td>
                                    <td>{{ $v->email }}</td>
                                    <td>{{ $v->status }} </td>
                                    @if (session()->get('usuario_vinculo')->id_nivel <= 2)
                                        <td class="d-flex justify-itens-between">
                                            <a href="{{ route('cadastro.empresa.editar', $v->id) }}">
                                                <button class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top" title="Editar"><i class="mdi mdi-pencil"></i> Editar</button>
                                            </a>
                                            <form action="{{ route('cadastro.empresa.destroy', $v->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="badge badge-danger" data-toggle="tooltip" data-placement="top" type="submit" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir o registro?')">
                                                    <i class="mdi mdi-delete"></i> Excluir
                                                </button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
