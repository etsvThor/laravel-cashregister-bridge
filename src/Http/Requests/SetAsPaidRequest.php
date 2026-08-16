<?php

namespace EtsvThor\CashRegisterBridge\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetAsPaidRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => 'required',
            'id' => 'required|numeric|min:1',
            'completed' => 'nullable|boolean',
        ];
    }
}
