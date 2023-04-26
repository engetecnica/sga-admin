@extends('dashboard')
@section('title', 'Requisições')
@section('content')


<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-access-point-network menu-icon"></i>
        </span> Ferramental
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>Requisições <i class="mdi mdi-check icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h3 class="page-title">
        <a href="{{ route('ferramental.requisicao.adicionar') }}">
            <button class="btn btn-sm btn-danger">Nova Requisição</button>
        </a>
    </h3>
</div>


<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <table class="table table-hover table-striped yajra-datatable">
                    <thead>
                        <tr>
                            <th width="8%">ID</th>
                            <th> Solicitante </th>
                            <th> Origem </th>
                            <th> Destino </th>
                            <th> Data de Solicitação </th>
                            <th> Data de Liberação </th>
                            <th> Status</th>
                            <th width="10%">Ações</th>
                        </tr>
                    </thead>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection