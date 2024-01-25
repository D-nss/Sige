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
            'modalidade' => 'required',
            'linha_extensao_id' => 'required',
            'areas_tematicas' => 'required',
            'ods' => 'required',
            'titulo' => 'required',
            'descricao' => 'required|max:2500',
            'publico_alvo' => 'required',
            // 'vagas_curricularizacao' => 'required',
            'estado' => 'required',
            'cidade' => 'required',
            'impactos_universidade' => 'required|max:2500',
            'impactos_sociedade' => 'required|max:2500',
            'arquivo' => 'required|file|max:5120|mimes:pdf',
        ];
    }
}
