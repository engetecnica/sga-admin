<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Artisan;


/* Configurações */
use App\Http\Controllers\ConfiguracaoController;
use App\Http\Controllers\ConfiguracaoMinhaContaController;
use App\Http\Controllers\ConfiguracaoUsuarioTipoController;
use App\Http\Controllers\ConfiguracaoUsuarioController;
use App\Http\Controllers\ConfiguracaoModuloController;
use App\Http\Controllers\ConfiguracaoSistemaController;

/* Cadastros */
use App\Http\Controllers\CadastroEmpresaController;
use App\Http\Controllers\CadastroFornecedorController;
use App\Http\Controllers\CadastroObraController;
use App\Http\Controllers\CadastroFuncionarioController;

/* Ativos */
use App\Http\Controllers\AtivoConfiguracaoController;
use App\Http\Controllers\AtivoExternoController;
use App\Http\Controllers\VeiculoController;

/* Ferramental */
use App\Http\Controllers\FerramentalRetiradaController;
use App\Http\Controllers\FerramentalRequisicaoController;

/* Anexos */
use App\Http\Controllers\AnexoController;
use App\Http\Controllers\ApiController;

/**
 * Consumindo API em Módulos
 * Redução de redundancia de pesquisa
 *
 * @Modulos
 *
 * 1.0 - Requisições
 *  1.1 - Listagem de Ativos (Popular Select - Form)
 */

use App\Http\Controllers\Api\ApiRequisicao;
use App\Http\Controllers\RelatorioAtivoInternoController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\RelatorioFornecedorController;
use App\Http\Controllers\RelatorioFuncionarioController;
use App\Http\Controllers\RelatorioObraController;
use App\Http\Controllers\RelatorioVeiculoController;
use App\Http\Controllers\VeiculoAbastecimentoController;
use App\Http\Controllers\VeiculoDepreciacaoController;
use App\Http\Controllers\VeiculoIpvaController;
use App\Http\Controllers\VeiculoManutencaoController;
use App\Http\Controllers\VeiculoQuilometragemController;
use App\Http\Controllers\VeiculoSeguroController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::fallback(function () {
    Alert::error('Que pena!', 'Este módulo está indisponível para você ou não foi encontrado.');
    return redirect(route('dashboard'));
});


Route::get('admin',                                               [CustomAuthController::class, 'index'])->name('admin');
Route::get('admin/login',                                         [CustomAuthController::class, 'index'])->name('login');
Route::post('admin/custom-login',                                 [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('admin/signout',                                       [CustomAuthController::class, 'signOut'])->name('signout');

/* Grupo de Rotas Autenticadas */
Route::group(['middleware' => 'auth'], function () {

    /* Configurações - Dashboard */
    Route::get('admin/configuracao',                              [ConfiguracaoController::class, 'index']);
    Route::get('admin/dashboard',                                 [CustomAuthController::class, 'dashboard'])->name('dashboard');

    /* Minha Conta */
    Route::get('admin/configuracao/minhaconta',                   [ConfiguracaoMinhaContaController::class, 'index'])->name('minhaconta');
    Route::post('admin/configuracao/minhaconta/store',            [ConfiguracaoMinhaContaController::class, 'store'])->name('minhaconta.store');

    /* Tipos de Usuário */
    Route::get('admin/configuracao/usuario_tipo',                 [ConfiguracaoUsuarioTipoController::class, 'index'])->name('usuario_tipo');
    Route::get('admin/configuracao/usuario_tipo/editar/{id?}',    [ConfiguracaoUsuarioTipoController::class, 'edit'])->name('usuario_tipo.editar');
    Route::get('admin/configuracao/usuario_tipo/adicionar',       [ConfiguracaoUsuarioTipoController::class, 'create'])->name('usuario_tipo.adicionar');
    Route::post('admin/configuracao/usuario_tipo/store',          [ConfiguracaoUsuarioTipoController::class, 'store'])->name('usuario_tipo.store');
    Route::post('admin/configuracao/usuario_tipo/update/{id}',    [ConfiguracaoUsuarioTipoController::class, 'update'])->name('usuario_tipo.update');

    /* Usuários */
    Route::get('admin/configuracao/usuario',                      [ConfiguracaoUsuarioController::class, 'index'])->name('usuario');
    Route::get('admin/configuracao/usuario/editar/{id?}',         [ConfiguracaoUsuarioController::class, 'edit'])->name('usuario.editar');
    Route::get('admin/configuracao/usuario/adicionar',            [ConfiguracaoUsuarioController::class, 'create'])->name('usuario.adicionar');
    Route::post('admin/configuracao/usuario/store',               [ConfiguracaoUsuarioController::class, 'store'])->name('usuario.store');
    Route::post('admin/configuracao/usuario/update/{id}',         [ConfiguracaoUsuarioController::class, 'update'])->name('usuario.update');

    /* Módulos */
    Route::get('admin/configuracao/modulo',                       [ConfiguracaoModuloController::class, 'index'])->name('modulo');
    Route::get('admin/configuracao/modulo/editar/{id?}',          [ConfiguracaoModuloController::class, 'edit'])->name('modulo.editar');
    Route::get('admin/configuracao/modulo/adicionar',             [ConfiguracaoModuloController::class, 'create'])->name('modulo.adicionar');
    Route::post('admin/configuracao/modulo/store',                [ConfiguracaoModuloController::class, 'store'])->name('modulo.store');
    Route::post('admin/configuracao/modulo/update/{id}',          [ConfiguracaoModuloController::class, 'update'])->name('modulo.update');

    /* Configurações - Sistema */
    Route::get('admin/configuracao/sistema',                      [ConfiguracaoSistemaController::class, 'index'])->name('sistema');
    Route::post('admin/configuracao/sistema/store',               [ConfiguracaoSistemaController::class, 'store'])->name('sistema.store');

    /* Cadastros */
    /* Cadastros - Cliente */
    Route::get('admin/cadastro/cliente',                          [CadastroClienteController::class, 'index'])->name('cadastro.cliente');
    Route::get('admin/cadastro/cliente/editar/{id?}',             [CadastroClienteController::class, 'edit'])->name('cadastro.cliente.editar');
    Route::get('admin/cadastro/cliente/adicionar',                [CadastroClienteController::class, 'create'])->name('cadastro.cliente.adicionar');
    Route::post('admin/cadastro/cliente/store',                   [CadastroClienteController::class, 'store'])->name('cadastro.cliente.store');
    Route::post('admin/cadastro/cliente/update/{id}',             [CadastroClienteController::class, 'update'])->name('cadastro.cliente.update');

    /* Cadastros - Empresa */
    Route::get('admin/empresa',                                   [CadastroEmpresaController::class, 'index'])->name('empresa');
    Route::get('admin/cadastro/empresa',                          [CadastroEmpresaController::class, 'index'])->name('cadastro.empresa');
    Route::get('admin/cadastro/empresa/editar/{id?}',             [CadastroEmpresaController::class, 'edit'])->name('cadastro.empresa.editar');
    Route::get('admin/cadastro/empresa/adicionar',                [CadastroEmpresaController::class, 'create'])->name('cadastro.empresa.adicionar');
    Route::post('admin/cadastro/empresa/store',                   [CadastroEmpresaController::class, 'store'])->name('cadastro.empresa.store');
    Route::post('admin/cadastro/empresa/update/{id}',             [CadastroEmpresaController::class, 'update'])->name('cadastro.empresa.update');




    /* Cadastros - Fornecedor */
    Route::get('admin/fornecedor',                                [CadastroFornecedorController::class, 'index'])->name('fornecedor');
    Route::get('admin/cadastro/fornecedor',                       [CadastroFornecedorController::class, 'index'])->name('cadastro.fornecedor');
    Route::get('admin/cadastro/fornecedor/editar/{id?}',          [CadastroFornecedorController::class, 'edit'])->name('cadastro.fornecedor.editar');
    Route::get('admin/cadastro/fornecedor/adicionar',             [CadastroFornecedorController::class, 'create'])->name('cadastro.fornecedor.adicionar');
    Route::post('admin/cadastro/fornecedor/store',                [CadastroFornecedorController::class, 'store'])->name('cadastro.fornecedor.store');
    Route::post('admin/cadastro/fornecedor/update/{id}',          [CadastroFornecedorController::class, 'update'])->name('cadastro.fornecedor.update');

    /* Cadastros - Obra */
    Route::get('admin/obra',                                                   [CadastroObraController::class, 'index'])->name('obra');
    Route::get('admin/cadastro/obra',                                          [CadastroObraController::class, 'index'])->name('cadastro.obra');
    Route::get('admin/cadastro/obra/editar/{id?}',                             [CadastroObraController::class, 'edit'])->name('cadastro.obra.editar');
    Route::get('admin/cadastro/obra/adicionar',                                [CadastroObraController::class, 'create'])->name('cadastro.obra.adicionar');
    Route::post('admin/cadastro/obra/store',                                   [CadastroObraController::class, 'store'])->name('cadastro.obra.store');
    Route::post('admin/cadastro/obra/update/{id}',                             [CadastroObraController::class, 'update'])->name('cadastro.obra.update');


    /* Cadastros - Funcionário */
    Route::get('admin/funcionario',                                                   [CadastroFuncionarioController::class, 'index'])->name('funcionario');
    Route::get('admin/cadastro/funcionario',                                          [CadastroFuncionarioController::class, 'index'])->name('cadastro.funcionario');
    Route::get('admin/cadastro/funcionario/editar/{id?}',                             [CadastroFuncionarioController::class, 'edit'])->name('cadastro.funcionario.editar');
    Route::get('admin/cadastro/funcionario/adicionar',                                [CadastroFuncionarioController::class, 'create'])->name('cadastro.funcionario.adicionar');
    Route::post('admin/cadastro/funcionario/store',                                   [CadastroFuncionarioController::class, 'store'])->name('cadastro.funcionario.store');
    Route::post('admin/cadastro/funcionario/update/{id}',                             [CadastroFuncionarioController::class, 'update'])->name('cadastro.funcionario.update');




    /* Ativo - Configuração */
    Route::get('admin/ativo', [AtivoConfiguracaoController::class, 'index'])->name('ativo');
    Route::get('admin/ativo/configuracao', [AtivoConfiguracaoController::class, 'index'])->name('ativo.configuracao');
    Route::get('admin/ativo/configuracao/editar/{id?}', [AtivoConfiguracaoController::class, 'edit'])->name('ativo.configuracao.editar');
    Route::get('admin/ativo/configuracao/adicionar', [AtivoConfiguracaoController::class, 'create'])->name('ativo.configuracao.adicionar');
    Route::post('admin/ativo/configuracao/store', [AtivoConfiguracaoController::class, 'store'])->name('ativo.configuracao.store');
    Route::post('admin/ativo/configuracao/update/{id}', [AtivoConfiguracaoController::class, 'update'])->name('ativo.configuracao.update');


    /* Ativo - Externo */
    Route::get('admin/ativo', [AtivoExternoController::class, 'index'])->name('ativo');
    Route::get('admin/ativo/externo', [AtivoExternoController::class, 'index'])->name('ativo.externo');
    Route::get('admin/ativo/externo/editar/{id?}', [AtivoExternoController::class, 'edit'])->name('ativo.externo.editar');
    Route::get('admin/ativo/externo/adicionar', [AtivoExternoController::class, 'create'])->name('ativo.externo.adicionar');
    Route::post('admin/ativo/externo/store', [AtivoExternoController::class, 'store'])->name('ativo.externo.store');
    Route::post('admin/ativo/externo/update/{id}', [AtivoExternoController::class, 'update'])->name('ativo.externo.update');

    Route::get('admin/ativo/externo/detalhes/{id}', [AtivoExternoController::class, 'show'])->name('ativo.externo.detalhes');

    Route::get('admin/ativo/externo/search/{id}', [AtivoExternoController::class, 'searchAtivoID'])->name('ativo.externo.search');
    Route::get('admin/ativo/externo/lista/{id?}', [AtivoExternoController::class, 'searchAtivoLista'])->name('ativo.externo.lista');


    /* Ativo - Veículos */
    Route::get('admin/ativo/veiculo', [VeiculoController::class, 'index'])->name('ativo.veiculo');
    Route::get('admin/ativo/veiculo/adicionar', [VeiculoController::class, 'create'])->name('ativo.veiculo.adicionar');
    Route::post('admin/ativo/veiculo/store', [VeiculoController::class, 'store'])->name('ativo.veiculo.store');
    Route::get('admin/ativo/veiculo/editar/{id}', [VeiculoController::class, 'edit'])->name('ativo.veiculo.editar');
    Route::post('admin/ativo/veiculo/update/{id}', [VeiculoController::class, 'update'])->name('ativo.veiculo.update');
    Route::post('admin/ativo/veiculo/delete/{id}', [VeiculoController::class, 'delete'])->name('ativo.veiculo.delete');

    /* Ativo - Veículos - Abastecimento */
    Route::get('admin/ativo/veiculo/abastecimento/{id}', [VeiculoAbastecimentoController::class, 'index'])->name('ativo.veiculo.abastecimento.index');
    Route::get('admin/ativo/veiculo/abastecimento/editar/{id}/{btn}', [VeiculoAbastecimentoController::class, 'edit'])->name('ativo.veiculo.abastecimento.editar');
    Route::post('admin/ativo/veiculo/abastecimento/store/{id}', [VeiculoAbastecimentoController::class, 'store'])->name('ativo.veiculo.abastecimento.store');
    Route::post('admin/ativo/veiculo/abastecimento/update/{id}', [VeiculoAbastecimentoController::class, 'update'])->name('ativo.veiculo.abastecimento.update');
    Route::post('admin/ativo/veiculo/abastecimento/delete/{id}', [VeiculoAbastecimentoController::class, 'delete'])->name('ativo.veiculo.abastecimento.delete');

    /* Ativo - Veículos - Depreciacao */
    Route::get('admin/ativo/veiculo/depreciacao/{id}', [VeiculoDepreciacaoController::class, 'index'])->name('ativo.veiculo.depreciacao.index');
    Route::get('admin/ativo/veiculo/depreciacao/editar/{id}', [VeiculoDepreciacaoController::class, 'edit'])->name('ativo.veiculo.depreciacao.editar');
    Route::post('admin/ativo/veiculo/depreciacao/store/{id}', [VeiculoDepreciacaoController::class, 'store'])->name('ativo.veiculo.depreciacao.store');
    Route::post('admin/ativo/veiculo/depreciacao/update/{id}', [VeiculoDepreciacaoController::class, 'update'])->name('ativo.veiculo.depreciacao.update');
    Route::post('admin/ativo/veiculo/depreciacao/delete/{id}', [VeiculoDepreciacaoController::class, 'delete'])->name('ativo.veiculo.depreciacao.delete');

    /* Ativo - Veículos - Ipva */
    Route::get('admin/ativo/veiculo/ipva/{id}', [VeiculoIpvaController::class, 'index'])->name('ativo.veiculo.ipva.index');
    Route::get('admin/ativo/veiculo/ipva/editar/{id}/{btn}', [VeiculoIpvaController::class, 'edit'])->name('ativo.veiculo.ipva.editar');
    Route::post('admin/ativo/veiculo/ipva/store/{id}', [VeiculoIpvaController::class, 'store'])->name('ativo.veiculo.ipva.store');
    Route::post('admin/ativo/veiculo/ipva/update/{id}', [VeiculoIpvaController::class, 'update'])->name('ativo.veiculo.ipva.update');
    Route::post('admin/ativo/veiculo/ipva/delete/{id}', [VeiculoIpvaController::class, 'delete'])->name('ativo.veiculo.ipva.delete');

    /* Ativo - Veículos - Manutencao */
    Route::get('admin/ativo/veiculo/manutencao/{id}', [VeiculoManutencaoController::class, 'index'])->name('ativo.veiculo.manutencao.index');
    Route::get('admin/ativo/veiculo/manutencao/editar/{id}/{btn}', [VeiculoManutencaoController::class, 'edit'])->name('ativo.veiculo.manutencao.editar');
    Route::post('admin/ativo/veiculo/manutencao/store/{id}', [VeiculoManutencaoController::class, 'store'])->name('ativo.veiculo.manutencao.store');
    Route::post('admin/ativo/veiculo/manutencao/update/{id}', [VeiculoManutencaoController::class, 'update'])->name('ativo.veiculo.manutencao.update');
    Route::post('admin/ativo/veiculo/manutencao/delete/{id}', [VeiculoManutencaoController::class, 'delete'])->name('ativo.veiculo.manutencao.delete');

    /* Ativo - Veículos - Quilometragem */
    Route::get('admin/ativo/veiculo/quilometragem/{id}', [VeiculoQuilometragemController::class, 'index'])->name('ativo.veiculo.quilometragem.index');
    Route::get('admin/ativo/veiculo/quilometragem/editar/{id}/{btn}', [VeiculoQuilometragemController::class, 'edit'])->name('ativo.veiculo.quilometragem.editar');
    Route::post('admin/ativo/veiculo/quilometragem/store/{id}', [VeiculoQuilometragemController::class, 'store'])->name('ativo.veiculo.quilometragem.store');
    Route::post('admin/ativo/veiculo/quilometragem/update/{id}', [VeiculoQuilometragemController::class, 'update'])->name('ativo.veiculo.quilometragem.update');
    Route::post('admin/ativo/veiculo/quilometragem/delete/{id}', [VeiculoQuilometragemController::class, 'delete'])->name('ativo.veiculo.quilometragem.delete');

    /* Ativo - Veículos - Seguro */
    Route::get('admin/ativo/veiculo/seguro/{id}', [VeiculoSeguroController::class, 'index'])->name('ativo.veiculo.seguro.index');
    Route::get('admin/ativo/veiculo/seguro/editar/{id}', [VeiculoSeguroController::class, 'edit'])->name('ativo.veiculo.seguro.editar');
    Route::post('admin/ativo/veiculo/seguro/store/{id}', [VeiculoSeguroController::class, 'store'])->name('ativo.veiculo.seguro.store');
    Route::post('admin/ativo/veiculo/seguro/update/{id}', [VeiculoSeguroController::class, 'update'])->name('ativo.veiculo.seguro.update');
    Route::post('admin/ativo/veiculo/seguro/delete/{id}', [VeiculoSeguroController::class, 'delete'])->name('ativo.veiculo.seguro.delete');

    /* Relatórios - Funcionários */
    Route::get('admin/relatorio/funcionarios', [RelatorioFuncionarioController::class, 'index'])->name('relatorio.funcionario.index');
    Route::post('admin/relatorio/funcionarios/gerar', [RelatorioFuncionarioController::class, 'gerar'])->name('relatorio.funcionario.gerar');
    Route::get('obras/select', [RelatorioFuncionarioController::class, 'select'])->name('obras.select');

    /* Relatórios - Fornecedores */
    Route::get('admin/relatorio/fornecedores', [RelatorioFornecedorController::class, 'index'])->name('relatorio.fornecedor.index');
    Route::post('admin/relatorio/fornecedores/gerar', [RelatorioFornecedorController::class, 'gerar'])->name('relatorio.fornecedor.gerar');

    /* Relatórios - Obras */
    Route::get('admin/relatorio/obras', [RelatorioObraController::class, 'index'])->name('relatorio.obra.index');
    Route::post('admin/relatorio/obras/gerar', [RelatorioObraController::class, 'gerar'])->name('relatorio.obra.gerar');

    /* Relatórios - Veículos */
    Route::get('admin/relatorio/veiculos', [RelatorioVeiculoController::class, 'index'])->name('relatorio.veiculo.index');
    Route::post('admin/relatorio/veiculos/gerar', [RelatorioVeiculoController::class, 'gerar'])->name('relatorio.veiculo.gerar');

    /* Relatórios - Ativos Internos */
    Route::get('admin/relatorio/ativos-internos', [RelatorioAtivoInternoController::class, 'index'])->name('relatorio.ativo.interno.index');
    Route::post('admin/relatorio/ativos-internos/gerar', [RelatorioAtivoInternoController::class, 'gerar'])->name('relatorio.ativo.interno.gerar');

    /* Relatórios - Externos */

    /* Ferramental - Retirada */
    Route::get('admin/ferramental', [FerramentalRetiradaController::class, 'index'])->name('ferramental');
    Route::get(
        'admin/ferramental/retirada',
        [FerramentalRetiradaController::class, 'index']
    )->name('ferramental.retirada');
    Route::get('admin/ferramental/retirada/editar/{id?}', [FerramentalRetiradaController::class, 'edit'])->name('ferramental.retirada.editar');
    Route::get('admin/ferramental/retirada/adicionar', [FerramentalRetiradaController::class, 'create'])->name('ferramental.retirada.adicionar');
    Route::post('admin/ferramental/retirada/store', [FerramentalRetiradaController::class, 'store'])->name('ferramental.retirada.store');
    Route::post('admin/ferramental/retirada/update/{id}', [FerramentalRetiradaController::class, 'update'])->name('ferramental.retirada.update');
    Route::get('admin/ferramental/retirada/detalhes/{id}', [FerramentalRetiradaController::class, 'show'])->name('ferramental.retirada.detalhes');
    Route::get('admin/ferramental/retirada/termo/{id}', [FerramentalRetiradaController::class, 'termo'])->name('ferramental.retirada.termo');
    Route::get('admin/ferramental/retirada/termo_assinar/{id}', [FerramentalRetiradaController::class, 'termo_assinar'])->name('ferramental.retirada.termo_assinar');
    Route::get('admin/ferramental/retirada/lista', [FerramentalRetiradaController::class, 'lista'])->name('ferramental.retirada.lista');
    Route::get('admin/ferramental/retirada/devolver/{id}', [FerramentalRetiradaController::class, 'devolver'])->name('ferramental.retirada.devolver');
    Route::post('admin/ferramental/retirada/salvar', [FerramentalRetiradaController::class, 'devolver_salvar'])->name('ferramental.retirada.devolver.salvar');
    Route::get('admin/ferramental/retirada/termo_download/{id}', [FerramentalRetiradaController::class, 'termo_download'])->name('ferramental.retirada.download');

    /* Ferramental - Requisição */
    Route::get('admin/ferramental', [FerramentalRequisicaoController::class, 'index'])->name('ferramental');
    Route::get('admin/ferramental/requisicao', [FerramentalRequisicaoController::class, 'index'])->name('ferramental.requisicao');
    Route::get('admin/ferramental/requisicao/editar/{id?}', [FerramentalRequisicaoController::class, 'edit'])->name('ferramental.requisicao.editar');
    Route::get('admin/ferramental/requisicao/adicionar', [FerramentalRequisicaoController::class, 'create'])->name('ferramental.requisicao.adicionar');
    Route::post('admin/ferramental/requisicao/store', [FerramentalRequisicaoController::class, 'store'])->name('ferramental.requisicao.store');
    Route::post('admin/ferramental/requisicao/update/{id}', [FerramentalRequisicaoController::class, 'update'])->name('ferramental.requisicao.update');

    /** Ferramental - Requisição API */
    Route::get('admin/ferramental/requisicao/lista_ativo/{term?}', [ApiRequisicao::class, 'lista_ativo'])->name('ferramental.requisicao.lista_ativo');
    Route::get('admin/ferramental/requisicao/ativo_externo_id/{id?}', [ApiRequisicao::class, 'ativo_externo_id'])->name('ferramental.requisicao.ativo_externo_id');


    /* Manipulação de Anexos */
    Route::post('admin/anexo/upload', [AnexoController::class, 'upload'])->name('anexo.upload');


    // Adicionar marca
    Route::post('adicionar-marca', [VeiculoController::class, 'adicionarMarca'])->name('adicionar.marca');


    /* API de Controles */
    Route::post(
        'admin/api/selecionar_obra',
        [ApiController::class, 'selecionar_obra']
    )->name('api.selecionar_obra');

    /**
     * Configurações Internas da Aplicação
     *
     * 1.0 - Função para remover cache
     * 2.0 - Migration Refresh
     */
    Route::get('/clear-cache', function () {
        Artisan::call('cache:clear');
        Artisan::call('route:cache');
        Artisan::call('config:cache');
        Artisan::call('view:clear');
        return 'Todos os caches foram limpos com sucesso. (cache, route, config, view)';
    });
});

Route::get('/refresh-migrate', function () {
    Artisan::call('refresh --seed');
});
