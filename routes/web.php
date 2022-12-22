<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;

use RealRashid\SweetAlert\Facades\Alert;

/* Site */
Use App\Http\Controllers\SiteController;

/* Configurações */
use App\Http\Controllers\ConfiguracaoController;
use App\Http\Controllers\ConfiguracaoMinhaContaController;
use App\Http\Controllers\ConfiguracaoUsuarioTipoController;
use App\Http\Controllers\ConfiguracaoUsuarioController;
use App\Http\Controllers\ConfiguracaoModuloController;
use App\Http\Controllers\ConfiguracaoSistemaController;

/* Cadastros */
use App\Http\Controllers\CadastroClienteController;
use App\Http\Controllers\CadastroEmpresaController;
use App\Http\Controllers\CadastroProdutoController;
use App\Http\Controllers\CadastroProdutoAssociarController;

/* Anexos */
use App\Http\Controllers\AnexoController;

/* PDV */
use App\Http\Controllers\VendaPdvController;

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


Route::get('/',                                         [SiteController::class, 'index'])->name('site');
Route::get('/',                                         [SiteController::class, 'index'])->name('admin');
Route::get('/admin',                                    [CustomAuthController::class, 'index'])->name('login');
Route::get('dashboard',                                 [CustomAuthController::class, 'dashboard'])->name('dashboard'); 
Route::get('login',                                     [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login',                             [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('signout',                                   [CustomAuthController::class, 'signOut'])->name('signout');


/* Grupo de Rotas Autenticadas */
Route::group(['middleware' => 'auth'], function () {

    /* Configurações - Dashboard */
    Route::get('configuracao',                              [ConfiguracaoController::class, 'index']);

    /* Minha Conta */
    Route::get('configuracao/minhaconta',                   [ConfiguracaoMinhaContaController::class, 'index'])->name('minhaconta');
    Route::post('configuracao/minhaconta/store',            [ConfiguracaoMinhaContaController::class, 'store'])->name('minhaconta.store');

    /* Tipos de Usuário */
    Route::get('configuracao/usuario_tipo',                 [ConfiguracaoUsuarioTipoController::class, 'index'])->name('usuario_tipo');
    Route::get('configuracao/usuario_tipo/editar/{id?}',    [ConfiguracaoUsuarioTipoController::class, 'edit'])->name('usuario_tipo.editar');
    Route::get('configuracao/usuario_tipo/adicionar',       [ConfiguracaoUsuarioTipoController::class, 'create'])->name('usuario_tipo.adicionar');
    Route::post('configuracao/usuario_tipo/store',          [ConfiguracaoUsuarioTipoController::class, 'store'])->name('usuario_tipo.store');
    Route::post('configuracao/usuario_tipo/update/{id}',    [ConfiguracaoUsuarioTipoController::class, 'update'])->name('usuario_tipo.update');

    /* Usuários */
    Route::get('configuracao/usuario',                      [ConfiguracaoUsuarioController::class, 'index'])->name('usuario');
    Route::get('configuracao/usuario/editar/{id?}',         [ConfiguracaoUsuarioController::class, 'edit'])->name('usuario.editar');
    Route::get('configuracao/usuario/adicionar',            [ConfiguracaoUsuarioController::class, 'create'])->name('usuario.adicionar');
    Route::post('configuracao/usuario/store',               [ConfiguracaoUsuarioController::class, 'store'])->name('usuario.store');
    Route::post('configuracao/usuario/update/{id}',         [ConfiguracaoUsuarioController::class, 'update'])->name('usuario.update');

    /* Módulos */
    Route::get('configuracao/modulo',                       [ConfiguracaoModuloController::class, 'index'])->name('modulo');
    Route::get('configuracao/modulo/editar/{id?}',          [ConfiguracaoModuloController::class, 'edit'])->name('modulo.editar');
    Route::get('configuracao/modulo/adicionar',             [ConfiguracaoModuloController::class, 'create'])->name('modulo.adicionar');
    Route::post('configuracao/modulo/store',                [ConfiguracaoModuloController::class, 'store'])->name('modulo.store');
    Route::post('configuracao/modulo/update/{id}',          [ConfiguracaoModuloController::class, 'update'])->name('modulo.update');

    /* Configurações - Sistema */
    Route::get('configuracao/sistema',                      [ConfiguracaoSistemaController::class, 'index'])->name('sistema');
    Route::post('configuracao/sistema/store',               [ConfiguracaoSistemaController::class, 'store'])->name('sistema.store');

    /* Cadastros */
    /* Cadastros - Cliente */
    Route::get('cadastro/cliente',                          [CadastroClienteController::class, 'index'])->name('cadastro.cliente');
    Route::get('cadastro/cliente/editar/{id?}',             [CadastroClienteController::class, 'edit'])->name('cadastro.cliente.editar');
    Route::get('cadastro/cliente/adicionar',                [CadastroClienteController::class, 'create'])->name('cadastro.cliente.adicionar');
    Route::post('cadastro/cliente/store',                   [CadastroClienteController::class, 'store'])->name('cadastro.cliente.store');
    Route::post('cadastro/cliente/update/{id}',             [CadastroClienteController::class, 'update'])->name('cadastro.cliente.update');

    /* Cadastros - Empresa */
    Route::get('empresa',                                   [CadastroEmpresaController::class, 'index'])->name('empresa');
    Route::get('cadastro/empresa',                          [CadastroEmpresaController::class, 'index'])->name('cadastro.empresa');
    Route::get('cadastro/empresa/editar/{id?}',             [CadastroEmpresaController::class, 'edit'])->name('cadastro.empresa.editar');
    Route::get('cadastro/empresa/adicionar',                [CadastroEmpresaController::class, 'create'])->name('cadastro.empresa.adicionar');
    Route::post('cadastro/empresa/store',                   [CadastroEmpresaController::class, 'store'])->name('cadastro.empresa.store');
    Route::post('cadastro/empresa/update/{id}',             [CadastroEmpresaController::class, 'update'])->name('cadastro.empresa.update');

    /* Cadastros - Produto */
    Route::get('produto',                                   [CadastroProdutoController::class, 'index'])->name('produto');
    Route::get('cadastro/produto',                          [CadastroProdutoController::class, 'index'])->name('cadastro.produto');
    Route::get('cadastro/produto/editar/{id?}',             [CadastroProdutoController::class, 'edit'])->name('cadastro.produto.editar');
    Route::get('cadastro/produto/adicionar',                [CadastroProdutoController::class, 'create'])->name('cadastro.produto.adicionar');
    Route::post('cadastro/produto/store',                   [CadastroProdutoController::class, 'store'])->name('cadastro.produto.store');
    Route::post('cadastro/produto/update/{id}',             [CadastroProdutoController::class, 'update'])->name('cadastro.produto.update');

    /* Cadastros - Associar Empresa/Lider ao Produto */
    Route::get('cadastro/produto/associar',                 [CadastroProdutoAssociarController::class, 'index'])->name('cadastro.produto.associar');
    Route::get('cadastro/produto/associar/editar/{id?}',    [CadastroProdutoAssociarController::class, 'edit'])->name('cadastro.produto.associar.editar');
    Route::get('cadastro/produto/associar/adicionar',       [CadastroProdutoAssociarController::class, 'create'])->name('cadastro.produto.associar.adicionar');
    Route::post('cadastro/produto/associar/store',          [CadastroProdutoAssociarController::class, 'store'])->name('cadastro.produto.associar.store');
    Route::post('cadastro/produto/associar/update/{id}',    [CadastroProdutoAssociarController::class, 'update'])->name('cadastro.produto.update');

    /* Ponto de Venda */
    Route::get('venda/pdv',                                 [VendaPdvController::class, 'index'])->name('venda.pontodevenda');
    Route::get('venda/adicionar',                           [VendaPdvController::class, 'create'])->name('venda.adicionar');


    /* 
        @function pesquisar_produto_por_empresa
        @int id_empresa
        @retornar produtos que não foram vinculados ainda
        @caso null ou false, nenhum produto encontrado
    */
    Route::post('cadastro/produto/associar/pesquisar_produto_por_empresa', 
        [
            CadastroProdutoAssociarController::class, 
            'pesquisar_produto_por_empresa'
        ]
    )->name('produto.associar.pesquisar_produto_por_empresa');



    Route::post('cadastro/produto/associar/pesquisar_empresa_por_produto', 
    [
        CadastroProdutoAssociarController::class, 
        'pesquisar_empresa_por_produto'
    ]
    )->name('produto.associar.pesquisar_empresa_por_produto');    



    

    /* Manipulação de Anexos */
    Route::post('anexo/salvar_anexo',                       [AnexoController::class, 'store'])->name('anexo.salvar');

});

/* Rotas do Site */

