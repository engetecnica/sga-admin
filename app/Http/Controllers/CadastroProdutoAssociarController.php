<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use RealRashid\SweetAlert\Facades\Alert;

use App\Traits\FuncoesAdaptadas;

use App\Models\ProdutoAssociar;
use App\Models\CadastroEmpresa;
use App\Models\CadastroProduto;
use App\Models\CadastroCliente;
use App\Models\Anexo;

use App\Http\Controllers\AnexoController as AnexoC;


class CadastroProdutoAssociarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use FuncoesAdaptadas;

    
    

    public function index()
    {
        //
        echo "Associar Produto - Lista";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //
        $empresas = CadastroEmpresa::withTrashed()->where('status', 'Ativo')->get(); // Filtro softDeletes + Status Ativo
        $produtos = CadastroProduto::withTrashed()->where('status', 'Ativo')->get(); // Filtro softDeletes + Status Ativo
        return view('pages.cadastros.produto_associar.form', compact('empresas', 'produtos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate(
            [
                'id_empresa' => 'required',
                'id_produto' => 'required',
                'valor_compra' => 'required',
                'valor_venda' => 'required',
                'lucro_obtido' => 'required',
                'status' => 'required'
            ], 
            [
                'id_empresa.required' => 'Selecione a Empresa Líder que deseja vincular',
                'id_produto.required' => 'Selecione o Produto que será vinculado',
                'valor_compra.required' => 'O valor de compra deve ser preenchido corretamente',
                'valor_venda.required' => 'O valor de venda deve ser preenchido corretamente',
                'lucro_obtido.required' => 'O lucro obtido deve ser preenchido corretamente',
                'status.required' => 'Selecione o Status'
            ]
        );


        $associar = new ProdutoAssociar();
        $associar->id_empresa = $request->id_empresa;
        $associar->id_produto = $request->id_produto;
        
        $associar->valor_compra = FuncoesAdaptadas::formata_moeda($request->valor_compra);
        $associar->valor_venda = FuncoesAdaptadas::formata_moeda($request->valor_venda);
        $associar->valor_lucro = FuncoesAdaptadas::formata_moeda($request->lucro_obtido);
        
        $associar->status = $request->status;

        $associar->save();
        $id_produto_configuracao = $associar->id;

        if($request->file('image'))
        {
            $anexo = new Anexo();
            
            /* Dados do Anexo */
            $anexo->id_anexo = 0;
            $anexo->id_usuario = Auth::user()->id;
            $anexo->id_modulo = 19; // Produtos
            $anexo->id_item = $id_produto_configuracao;
            $anexo->titulo = "Imagem do Produto ".$id_produto_configuracao;
            $anexo->tipo = AnexoC::store($request)->tipo;
            $anexo->arquivo = AnexoC::store($request)->arquivo;
            $anexo->descricao = null;

            $anexo->save();
            
        }

        Alert::success('Muito bem ;)', 'O produto foi associado à sua conta com sucesso!');
        return redirect('cadastro/produto/associar');   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProdutoAssociar  $produtoAssociar
     * @return \Illuminate\Http\Response
     */
    public function show(ProdutoAssociar $produtoAssociar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProdutoAssociar  $produtoAssociar
     * @return \Illuminate\Http\Response
     */
    public function edit(ProdutoAssociar $produtoAssociar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProdutoAssociar  $produtoAssociar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProdutoAssociar $produtoAssociar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProdutoAssociar  $produtoAssociar
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProdutoAssociar $produtoAssociar)
    {
        //
    }





    public function pesquisar_produto_por_empresa(Request $request)
    {
        $id_empresa = ($request->id_empresa) ?? null;
        $route = ($request->route) ?? null;

        if ($id_empresa == false) {
            //return "<option value=''>Todos os produtos já foram vinculados ou nenhum produto foi cadastrado.</option>";
        }

        /* Produtos - Associados */
        if ($route == '/venda/adicionar') {

            $produtos_venda = ProdutoAssociar::select('p.titulo', 'produtos_configuracoes.*')
            ->where('id_empresa', $id_empresa)
                ->join('produtos as p', 'p.id', '=', 'produtos_configuracoes.id_produto')
                ->get()
                ->toArray();

            /* Se tiver > 0, exibe */
            


            if (count($produtos_venda) > 0) {
                //echo "<option value=''>Selecione um Produto</option>";
                foreach ($produtos_venda as $produto) {
                    //echo "<option value='" . $produto['id'] . "'>" . $produto['titulo'] . "</option>";
                }
            } else {
                //return "<option value=''>Não há produto a ser vinculado.</option>";
            }
        } else {

            $produtos = ProdutoAssociar::select('id')->where('id_empresa', $id_empresa)->get()->toArray();
            if ($produtos) {
                foreach ($produtos as $produto) {
                    $ids[] = $produto['id'];
                    $produtos_venda = CadastroProduto::select('titulo', 'id')->whereNotIn('id', $ids)->get()->toArray();
                }
            } else {
                $ids = [];
                $produtos_venda = CadastroProduto::select('titulo', 'id')->get()->toArray();
            }



            //print_r($produtos_venda);

            /* Se tiver > 0, exibe */
            if (count($produtos_venda) > 0) {
                // echo "<option value=''>Selecione um Produto</option>";
                foreach ($produtos_venda as $produto) {
                    //echo "<option value='" . $produto['id'] . "'>" . $produto['titulo'] . "</option>";
                }
            } else {
                //return "<option value=''>Não há produto a ser vinculado.</option>";
            }
            
        }


        $clientes = CadastroCliente::where('id_empresa', $id_empresa)->orderBy('nome', 'ASC')->get()->toArray();

        //print_r($clientes);

        $dados = array('clientes' => $clientes, 'produtos' => $produtos_venda);

        return json_encode($dados);





        //return  $produtos+$clinente > json lista
    }


    public function pesquisar_empresa_por_produto(Request $request)
    {
        $produtos = ProdutoAssociar::where('id_produto', $request->id_produto)->get()->toArray();
        dd($produtos);
    }
}