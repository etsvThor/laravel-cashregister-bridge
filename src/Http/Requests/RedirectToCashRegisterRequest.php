<?php

namespace EtsvThor\CashRegisterBridge\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RedirectToCashRegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'items' => 'required|array',
            'items.*.type' => 'required',
            'items.*.id' => 'required|numeric|min:1',
        ];
    }
}
