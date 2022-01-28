<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min: 10|max:100',
            'description' => 'required|string|min:50',
            'additionalInformation' => '',
            'category' => 'required|string',
            'price' => 'required|numeric|max:999999',
            'quantity' => 'required|numeric',
            'image' => 'required|image'
        ];
    }
}
