<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAcaoExtensaoRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'tipo' => 'required',
            'linha_extensao_id' => 'required',
            'areas_tematicas' => 'required',
            'titulo' => 'required',
            'descricao' => 'required|max:2500',
            'publico_alvo' => 'required',
            'data_inicio' => 'required',
            'estado' => 'required',
            'cidade' => 'required',
            'situacao' => 'required',
            'unidade_id' => 'required',
            'nome_coordenador' => 'required',
            'tipo_coordenador' => 'required',
            'impactos_universidade' => 'required|max:2500',
            'impactos_sociedade' => 'required|max:2500',
            'grau_envolvimento_equipe_id' => 'required',
            'investimento' => 'required'
        ];
    }
}
