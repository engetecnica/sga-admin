@extends('dashboard')
@section('title', 'Fornecedores')
@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary me-2 text-white">
                <i class="mdi mdi-access-point-network menu-icon"></i>
            </span> Fornecedores
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
            <a href="{{ route('cadastro.fornecedor.adicionar') }}">
                <button class="btn btn-sm btn-danger">Novo Registro</button>
            </a>
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
                                <th width="10%">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fornecedores as $fornecedor)
                                <tr>
                                    <td><span class="badge badge-dark">{{ $fornecedor->id }}</span></td>
                                    <td>{{ $fornecedor->cnpj ?? '-' }}</td>
                                    <td>{{ $fornecedor->razao_social }}</td>
                                    <td>{{ $fornecedor->celular }}</td>
                                    <td>{{ $fornecedor->email }}</td>
                                    <td>{{ $fornecedor->status }} </td>
                                    <td>
                                        <button class="badge badge-success" data-toggle="modal" data-target="#modal-contato-{{ $fornecedor->id }}"><i class="mdi mdi-pencil"></i> Ver contatos</button>

                                        <div class="modal fade" id="modal-contato-{{ $fornecedor->id }}" aria-hidden="true" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <p class="text-primary text-center"><strong>{{ $fornecedor->razao_social }} ({{ $fornecedor->cnpj ?? '-' }})</strong></p>
                                                        <p><strong>Contatos</strong></p>
                                                        <ul>
                                                            @foreach ($fornecedor->contatos as $contato)
                                                                <li class=""><strong>Setor: {{ $contato->setor }}</strong> <br>
                                                                    <table class="w-100 table">
                                                                        <tr>
                                                                            <td style="width: 33%">{{ $contato->nome }}</td>
                                                                            <td style="width: 33%">{{ $contato->email }}</td>
                                                                            <td style="width: 33%">{{ $contato->telefone }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                        <div class="text-right">
                                                            <button class="btn btn-secondary" data-dismiss="modal" type="button">Fechar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <a href="{{ route('cadastro.fornecedor.editar', $fornecedor->id) }}">
                                            <button class="badge badge-info" data-toggle="tooltip" data-placement="top" title="Editar"><i class="mdi mdi-pencil"></i> Editar</button>
                                        </a>

                                        <form action="{{ route('cadastro.fornecedor.destroy', $fornecedor->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="badge badge-danger" data-toggle="tooltip" data-placement="top" type="submit" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir o registro?')">
                                                <i class="mdi mdi-delete"></i> Excluir
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
