<?php

namespace EtsvThor\CashRegisterBridge\Http\Requests;

use Closure;
use EtsvThor\CashRegisterBridge\Contracts\HasExternalProductItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class RedirectToCashRegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'items' => 'required|array',
            'items.*.type' => [
                'required',
                'string',
                function (string $attribute, mixed $value, Closure $fail) {
                    if (! is_string($value) || ! class_exists($value)) {
                        $fail("The {$attribute} must be a valid class name.");

                        return;
                    }

                    if (! is_subclass_of($value, Model::class) || ! is_subclass_of($value, HasExternalProductItem::class)) {
                        $fail("The {$attribute} must be an Eloquent model implementing HasExternalProductItem.");
                    }
                },
            ],
            'items.*.id' => 'required|numeric|min:1',
            'redirect_url' => 'nullable|string|url',
        ];
    }
}
