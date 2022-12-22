@extends('dashboard')
@section('title', 'Dashboard')
@section('content')

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-access-point-network menu-icon"></i>
        </span> Dashboard
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>Visão geral do SGCR <i class="mdi mdi-check icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>
</div>
<div class="row">
    <div class="col-xl-9 col-sm-12">
        <div class="row">
            <div class="col-sm-12">
                <div class="d-flex align-items-center mb-3">
                    <h3 class="m-0 pr-2">Bom dia, André!</h3>
                </div>
                <div class="card card-blue grid-margin">
                    <div class="card-body">
                        <div class="d-lg-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h4>Hoje é dia 09 de Agosto de 2022. </h4>
                                <h5 class="m-0">Você possui (5) novas vendas através do site BLUETV.APP</h5>
                                <h5 class="m-0">Você possui (2) novas mensagens</h5>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mt-3">
            <div class="col-sm-4 grid-margin">
                <div class="card bg-gradient-danger text-white">
                    <div class="card-body">
                        <div class="grey-circle-profile-icon">
                            <i class="mdi mdi-currency-usd"></i>
                        </div>
                        <h2 class="mb-0 mt-3">R$ 6.652,85</h2>
                        <h5 class="font-weight-normal mb-3">Total de Vendas</h5>
                        <p class="text-medium m-0">Mês de Agosto / 2022</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 grid-margin">
                <div class="card bg-gradient-success text-white">
                    <div class="card-body">
                        <div class="grey-circle-profile-icon">
                            <i class="mdi mdi-cash-usd"></i>
                        </div>
                        <h2 class="mb-0 mt-3">R$ 2.350,25</h2>
                        <h5 class="font-weight-normal mb-3">Total de Vendas</h5>
                        <p class="text-medium m-0">Hoje, 09 de Agosto de 2022</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 grid-margin">
                <div class="card bg-gradient-primary text-white">
                    <div class="card-body">
                        <div class="grey-circle-profile-icon">
                            <i class="mdi mdi-truck"></i>
                        </div>
                        <h2 class="mb-0 mt-3">125</h2>
                        <h5 class="font-weight-normal mb-3">Produtos em Estoque</h5>
                        <p class="text-medium m-0">Disponíveis para Venda</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 grid-margin grid-margin-xl-0">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Últimas Vendas</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check m-0">
                                                <label class="form-check-label">
                                                    <input class="checkbox" type="checkbox"> <i class="input-helper"></i><i class="input-helper"></i></label>
                                            </div>
                                        </th>
                                        <th> Data </th>
                                        <th> Produto </th>
                                        <th> Cliente </th>
                                        <th> Custo </th>
                                        <th> Valor Pago  </th>
                                        <th> Visualizar </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-check m-0">
                                                <label class="form-check-label">
                                                    <input class="checkbox" type="checkbox"> <i class="input-helper"></i><i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>09/08/2022 12:15:10 </td>
                                        <td> Blue TV 30 dias</td>
                                        <td>Eduardo Figueiredo</td>
                                        <td>R$ 13,90</td>
                                        <td>R$ 24,00</td>
                                        <td> <button class="btn btn-sm btn-gradient-success">Visualizar Venda</button> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-12">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header">
                    <div class="d-lg-flex w-100 justify-content-between align-items-center">
                        <h4 class="mb-0 font-weight-medium mr-3">Notificações Recentes</h4>
                        <a href="#" class="mb-0 text-medium text-muted">Visualizar Todas</a>
                    </div>
                </div>
                <div class="card grid-margin-sm">
                    <div class="card-body px-3 py-4">
                        <h5 class="mb-3">Venda <b>Blue TV Anual </b></h5>
                        <h5 class="mb-3">Hoje, 10:25:36</h5>
                        <div class="d-flex mb-2">
                            <div class="btn btn-info btn-sm">Eduardo Figueiredo</div>
                            <div class="btn btn-primary btn-sm" style="margin-left: 5px">(48) 9 9803-6366</div>
                        </div>
                        <div class="d-flex mb-2">    
                            <div class="badge badge-warning">Blue TV Anual</div>                            
                            <div class="badge badge-danger" style="margin-left: 5px">R$ 169,90</div>
                        </div>
                        <div class="d-flex mb-2"> 
                            <div class="badge badge-success">BLUETV.APP</div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection