@extends('dashboard')
@section('title', 'PDV - Ponto de Venda Principal')
@section('content')



<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-access-point-network menu-icon"></i>
        </span> Ponto de Venda
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>Registrar Venda<i class="mdi mdi-check icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>
</div>


<div class="row">
    <div class="col-xl-12 col-sm-12">
        <div class="card card-statistics">
            <div class="row">

                <div class="card-col col-xl-3 col-lg-3 col-md-3 col-6 border-right">

                    <a href="{{ route('venda.adicionar') }}" class="registrar-venda">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center flex-column flex-sm-row">
                                <i class="mdi mdi-cash-multiple text-primary mr-0 mr-sm-4 icon-lg margin-right-15"></i>
                                <div class="wrapper text-sm-left">
                                    <p class="card-text mb-0">Registrar</p>
                                    <div class="fluid-container">
                                        <h3 class="mb-0 font-weight-medium">Venda</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="card-col col-xl-3 col-lg-3 col-md-3 col-6 border-right">
                    <a href="{{ route('cadastro.cliente.adicionar') }}" class="registrar-venda">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center flex-column flex-sm-row">
                                <i class="mdi mdi-cellphone-link text-primary mr-0 mr-sm-4 icon-lg  margin-right-15"></i>
                                <div class="wrapper text-sm-left">
                                    <p class="card-text mb-0">Adicionar</p>
                                    <div class="fluid-container">
                                        <h3 class="mb-0 font-weight-medium">Cliente</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="card-col col-xl-3 col-lg-3 col-md-3 col-6 border-right">
                    <a href="{{ route('cadastro.produto') }}" class="registrar-venda">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center flex-column flex-sm-row">
                                <i class="mdi mdi-fingerprint text-primary mr-0 mr-sm-4 icon-lg  margin-right-15"></i>
                                <div class="wrapper text-sm-left">
                                    <p class="card-text mb-0">Meus</p>
                                    <div class="fluid-container">
                                        <h3 class="mb-0 font-weight-medium">Produtos</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="card-col col-xl-3 col-lg-3 col-md-3 col-6">
                    <a href="{{ route('venda.adicionar') }}" class="registrar-venda">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center flex-column flex-sm-row">
                                <i class="mdi mdi-keyboard text-primary mr-0 mr-sm-4 icon-lg  margin-right-15"></i>
                                <div class="wrapper text-sm-left">
                                    <p class="card-text mb-0">Emitir</p>
                                    <div class="fluid-container">
                                        <h3 class="mb-0 font-weight-medium">Relatório</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                    <div class="card-body">
                        <img src="../../../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
                        <h4 class="font-weight-normal mb-3">Vendas Últimos 7 dias <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">R$ <?php echo number_format($relatorio['7_dias']['liquido'], 2, ',', '.'); ?></h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                        <img src="../../../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
                        <h4 class="font-weight-normal mb-3">Vendas Útimos 15 dias <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">R$ <?php echo number_format($relatorio['14_dias']['liquido'], 2, ',', '.'); ?></h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <img src="../../../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
                        <h4 class="font-weight-normal mb-3">Vendas Últimos 30 dias <i class="mdi mdi-diamond mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">R$ <?php echo number_format($relatorio['30_dias']['liquido'], 2, ',', '.'); ?></h2>
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
                            <table class="table table-striped">
                                <thead>

                                    <tr>
                                        <th> Data </th>
                                        <th> Produto </th>
                                        <th> Cliente </th>
                                        <th> Custo </th>
                                        <th> Valor Pago </th>
                                        <th> Visualizar </th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php foreach ($vendas as $venda) { ?>
                                        <tr>
                                            <td><?php echo $venda['data_venda']; ?> </td>
                                            <td><?php echo $venda['titulo_produto']; ?></td>
                                            <td><?php echo $venda['nome_cliente']; ?></td>
                                            <td>R$ <?php echo number_format($venda['valor_compra'], 2, ',', '.'); ?></td>
                                            <td>R$ <?php echo number_format($venda['valor_venda'], 2, ',', '.'); ?></td>
                                            <td>
                                                <a href="{{ url('venda/detalhes/'.$venda['id']) }}">
                                                    <button class="btn btn-sm btn-gradient-success">Visualizar Venda</button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection