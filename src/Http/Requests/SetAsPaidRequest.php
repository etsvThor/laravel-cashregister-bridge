<?php

namespace EtsvThor\CashRegisterBridge\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetAsPaidRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required',
            'id' => 'required|numeric|min:1',
            'completed' => 'nullable|boolean',
        ];
    }
}
