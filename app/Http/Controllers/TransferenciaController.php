<?php

namespace App\Http\Controllers;

use App\Models\CadastroEmpresa;
use App\Models\CadastroFornecedor;
use Illuminate\Http\Request;

use App\Models\Transferencia;
use App\Models\{AtivoConfiguracao, AtivoExterno, AtivoExternoEstoque, CadastroFuncao, CadastroObra, CadastroFuncionario};

class TransferenciaController extends Controller
{
    //
    public function index()
    {
        return view('pages.transferencia.index');
    }

    /** Transferência de Obras */
    public function obra()
    {
        $obras = Transferencia::getObrasSGA();
        return view('pages.transferencia.obra', compact('obras'));
    }

    public function obra_store(Request $request)
    {

        $obras = Transferencia::getObrasSGA();
        $obras_gestao = CadastroObra::count();

        if ($obras->count() == $obras_gestao) {
            return redirect()->route('transferencia.obra')->with('fail', 'Estes dados já foram importados no sistema.');
        }

        try {

            foreach ($obras as $o) {
                $obra = new CadastroObra();
                $obra->id = $o->id_obra;
                $obra->id_empresa = $o->id_empresa;
                $obra->nome_fantasia = $o->codigo_obra;
                $obra->codigo_obra = $o->codigo_obra;
                $obra->razao_social = $o->obra_razaosocial;
                $obra->cnpj = $o->obra_cnpj;
                $obra->cep = $o->endereco_cep;
                $obra->endereco = $o->endereco;
                $obra->numero = $o->endereco_numero;
                $obra->bairro = $o->endereco_bairro;
                $obra->cidade = $o->endereco_cidade;
                $obra->estado = $o->endereco_estado;
                $obra->email = $o->responsavel_email;
                $obra->celular = $o->responsavel_celular;
                $obra->status = ($o->situacao == 0) ? 'Ativo' : 'Inativo';
                $obra->save();
            }

            return redirect()->route('transferencia.obra')->with('success', 'Dados importados com sucesso!');
        } catch (\Illuminate\Database\QueryException $exception) {

            return redirect()->route('transferencia.obra')->with('fail', 'Erro: ' . $exception->errorInfo[2]);
        }
    }


    /** Transferência de Empresas */
    public function empresa()
    {
        $empresas = Transferencia::getEmpresasSGA();
        return view('pages.transferencia.empresa', compact('empresas'));
    }

    public function empresa_store(Request $request)
    {

        $empresas = Transferencia::getEmpresasSGA();
        $empresas_gestao = CadastroEmpresa::count();

        if ($empresas->count() == $empresas_gestao) {
            return redirect()->route('transferencia.empresa')->with('fail', 'Estes dados já foram importados no sistema.');
        }

        try {

            foreach ($empresas as $o) {
                $empresa = new CadastroEmpresa();
                $empresa->id = $o->id_empresa;
                $empresa->nome_fantasia = $o->nome_fantasia;
                $empresa->razao_social = $o->razao_social;
                $empresa->cnpj = $o->cnpj;
                $empresa->cep = $o->endereco_cep;
                $empresa->endereco = $o->endereco;
                $empresa->numero = $o->endereco_numero;
                $empresa->bairro = $o->endereco_bairro;
                $empresa->cidade = $o->endereco_cidade;
                $empresa->estado = $o->endereco_estado;
                $empresa->email = $o->responsavel_email;
                $empresa->celular = $o->responsavel_celular;
                $empresa->status = ($o->situacao == 0) ? 'Ativo' : 'Inativo';
                $empresa->save();
            }

            return redirect()->route('transferencia.empresa')->with('success', 'Dados importados com sucesso!');
        } catch (\Illuminate\Database\QueryException $exception) {

            return redirect()->route('transferencia.empresa')->with('fail', 'Erro: ' . $exception->errorInfo[2]);
        }
    }


    /** Transferência de Fornecedores */
    public function fornecedor()
    {
        $fornecedores = Transferencia::getFornecedoresSGA();
        return view('pages.transferencia.fornecedor', compact('fornecedores'));
    }

    public function fornecedor_store(Request $request)
    {

        $fornecedores = Transferencia::getFornecedoresSGA();
        $fornecedores_gestao = CadastroFornecedor::count();

        if ($fornecedores->count() == $fornecedores_gestao) {
            return redirect()->route('transferencia.fornecedor')->with('fail', 'Estes dados já foram importados no sistema.');
        }

        try {

            foreach ($fornecedores as $o) {
                $fornecedor = new CadastroFornecedor();
                $fornecedor->id = $o->id_fornecedor;
                $fornecedor->nome_fantasia = $o->nome_fantasia;
                $fornecedor->razao_social = $o->razao_social;
                $fornecedor->cnpj = $o->cnpj;
                $fornecedor->cep = $o->endereco_cep;
                $fornecedor->endereco = $o->endereco;
                $fornecedor->numero = $o->endereco_numero;
                $fornecedor->bairro = $o->endereco_bairro;
                $fornecedor->cidade = $o->endereco_cidade;
                $fornecedor->estado = $o->endereco_estado;
                $fornecedor->email = $o->responsavel_email;
                $fornecedor->celular = $o->responsavel_celular;
                $fornecedor->status = ($o->situacao == 0) ? 'Ativo' : 'Inativo';
                $fornecedor->save();
            }

            return redirect()->route('transferencia.fornecedor')->with('success', 'Dados importados com sucesso!');
        } catch (\Illuminate\Database\QueryException $exception) {

            return redirect()->route('transferencia.fornecedor')->with('fail', 'Erro: ' . $exception->errorInfo[2]);
        }
    }


    /** Transferência de Fornecedores */
    public function funcionario()
    {
        $funcionarios = Transferencia::getFuncionariosSGA();
        return view('pages.transferencia.funcionario', compact('funcionarios'));
    }

    public function funcionario_store(Request $request)
    {

        $funcionarios = Transferencia::getFuncionariosSGA();
        $funcionarios_gestao = CadastroFuncionario::count();

        if ($funcionarios->count() == $funcionarios_gestao) {
            return redirect()->route('transferencia.funcionario')->with('fail', 'Estes dados já foram importados no sistema.');
        }

        try {

            /** Cadastra Funções */
            // $funcoes = Transferencia::getFuncionariosFuncoesSGA();

            // foreach ($funcoes as $func) {
            //     $funcao = new CadastroFuncao();
            //     $funcao->codigo_cbo = $func->codigo_interno;
            //     $funcao->titulo = $func->titulo;
            //     $funcao->save();
            // }

            /** 
             * Cadastra Funcionários 
             * Ocultado ID_FUNCAO
             * */
            foreach ($funcionarios as $func) {
                $funcionario = new CadastroFuncionario();
                $funcionario->id = $func->id_funcionario;
                $funcionario->matricula = $func->matricula;
                $funcionario->id_obra = $func->id_obra;
                $funcionario->nome = strtoupper($func->nome);
                $funcionario->data_nascimento = $func->data_nascimento;
                $funcionario->cpf = $func->cpf;
                $funcionario->rg = $func->rg;
                $funcionario->cep = $func->endereco_cep;
                $funcionario->endereco = $func->endereco;
                $funcionario->numero = $func->endereco_numero;
                $funcionario->bairro = $func->endereco_bairro;
                $funcionario->cidade = $func->endereco_cidade;
                $funcionario->estado = $func->endereco_estado;
                $funcionario->email = $func->email ?? null;
                $funcionario->celular = $func->celular;
                $funcionario->status = ($func->situacao == 0) ? 'Ativo' : 'Inativo';
                $funcionario->save();
            }

            return redirect()->route('transferencia.funcionario')->with('success', 'Dados importados com sucesso!');
        } catch (\Illuminate\Database\QueryException $exception) {

            return redirect()->route('transferencia.funcionario')->with('fail', 'Erro: ' . $exception->errorInfo[2]);
        }
    }

    /** Transferência de Configurações de Ativos */
    public function ativo_configuracao()
    {
        $configuracoes = Transferencia::getAtivoConfiguracaoSGA();
        return view('pages.transferencia.ativo_configuracao', compact('configuracoes'));
    }

    public function ativo_configuracao_store(Request $request)
    {
        $ativo_configuracao = Transferencia::getAtivoConfiguracaoSGA();
        $ativo_configuracao_gestao = AtivoConfiguracao::count();

        if ($ativo_configuracao->count() == $ativo_configuracao_gestao) {
            return redirect()->route('transferencia.ativo_configuracao')->with('fail', 'Estes dados já foram importados no sistema.');
        }

        try {

            /** 
             * Cadastra Funcionários 
             * Ocultado ID_FUNCAO
             * */
            foreach ($ativo_configuracao as $config) {
                $configuracao = new AtivoConfiguracao();
                $configuracao->id_relacionamento = $config->id_ativo_configuracao_vinculo;
                $configuracao->titulo = $config->titulo;
                $configuracao->status = "Ativo";
                $configuracao->save();
            }

            return redirect()->route('transferencia.ativo_configuracao')->with('success', 'Dados importados com sucesso!');
        } catch (\Illuminate\Database\QueryException $exception) {

            return redirect()->route('transferencia.ativo_configuracao')->with('fail', 'Erro: ' . $exception->errorInfo[2]);
        }
    }




    /** Transferência de Configurações de Ativos */
    public function ativo()
    {
        $ativos = Transferencia::getAtivoExternoSGA();
        return view('pages.transferencia.ativo', compact('ativos'));
    }

    public function ativo_store(Request $request)
    {
        $ativo = $ativo_grupo = Transferencia::getAtivoExternoSGA();
        $ativo_gestao = AtivoExterno::count();

        if ($ativo->count() == $ativo_gestao) {
            return redirect()->route('transferencia.ativo')->with('fail', 'Estes dados já foram importados no sistema.');
        }

        try {
            /** Retorno dos Ativos conforme o Titulo */
            foreach ($ativo_grupo as $grupo) {
                $group = new AtivoExterno();
                $group->id_ativo_configuracao = $grupo->id_ativo_externo_categoria;
                $group->titulo = $grupo->nome;
                $group->status = 'Ativo';
                $group->save();

                $id_ativo_externo = $group->id;
                $ativo_lista = Transferencia::getAtivoExternoByNomeSGA($grupo->nome);

                foreach ($ativo_lista as $ativoObra) {
                    $ativo_estoque = new AtivoExternoEstoque();
                    $ativo_estoque->id_ativo_externo = $id_ativo_externo;
                    $ativo_estoque->id_obra  = $ativoObra->id_obra;
                    $ativo_estoque->patrimonio = $ativoObra->codigo;
                    $ativo_estoque->data_descarte = $ativoObra->data_descarte;
                    $ativo_estoque->valor = $ativoObra->valor;
                    $ativo_estoque->calibracao = $ativoObra->necessita_calibracao;
                    $ativo_estoque->status = $situacao ?? null;
                    $ativo_estoque->created_at = $ativoObra->data_inclusao;
                    $ativo_estoque->save();
                }
            }
            return redirect()->route('transferencia.ativo')->with('success', 'Dados importados com sucesso!');
        } catch (\Illuminate\Database\QueryException $exception) {
            return redirect()->route('transferencia.ativo')->with('fail', 'Erro: ' . $exception->errorInfo[2]);
        }
    }

    /** Transferência de Configurações de Ativos */
    public function veiculo()
    {
        $veiculos = Transferencia::getVeiculoSGA();
        return view('pages.transferencia.veiculo', compact('veiculos'));
    }


    /** Executar todas as transferências */
    public function todas(Request $request)
    {

        /** Sincroniza dados com a tabela antiga */

        TransferenciaController::empresa_store($request);

        TransferenciaController::obra_store($request);

        TransferenciaController::fornecedor_store($request);

        TransferenciaController::funcionario_store($request);

        TransferenciaController::ativo_configuracao_store($request);

        TransferenciaController::ativo_store($request);

        return redirect()->route('transferencia.ativo')->with('success', 'Dados importados com sucesso!');
    }
}
