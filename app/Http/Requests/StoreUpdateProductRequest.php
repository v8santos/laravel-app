<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProductRequest extends FormRequest
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
        $id = $this->segment(2);

        return [
            'name' => "required|min:3|max:255|unique:products,name,{$id},id",
            'description' => 'required|min:3|max:10000',
            'price' => "required|regex:/^\d+(\.\d{1,2})?$/",
            'image' => 'nullable|image'
        ];
    }

    /**
     * Get custom messages for validator errors
     * 
     * @return array
     */
    /* 
    public function messages()
    {
        return [
            'name.required' => 'Campo nome obrigatório',
            'name.min' => 'Nome deve conter no minimo 3 caracteres',
            'name.max' => 'Nome deve conter no máximo 255 caracteres',
            'description.required' => 'Campo descrição obrigatório',
            'description.min' => 'Descrição deve conter no minimo 3 caracteres',
            'description.max' => 'Descrição deve conter no máximo 10000 caracteres',
            'price.required' => 'Campo preço obrigatório'
        ];
    } */
}
