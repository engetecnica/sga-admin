<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContatoFornecedorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id_fornecedor' => 'required',
            'setor' => 'required',
            'nome' => 'required',
            'email' => 'required|email',
            'telefone' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'id_fornecedor.required' => 'É necessário preencher o ID do fornecedor',
            'setor.required' => 'É necessário preencher o Setor do contato',
            'nome.required' => 'É necessário preencher o Nome do responsável do contato',
            'email.required' => 'É necessário preencher o Email do contato',
            'email.email' => 'Este e-mail não é válido para o contato',
            'telefone.required' => 'É necessário preencher o Telefone do contato'
        ];
    }
}
