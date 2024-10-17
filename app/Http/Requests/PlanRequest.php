<?php

namespace App\Http\Requests;

use App\Rules\IniAmount;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'              => [
                'required',
                'string',
                'max:190'
            ],
            'description'     => ['nullable', 'string'],
            'price'            => ['required', new IniAmount()],
            'validity'            => ['required', 'numeric'],
            'status'   => ['required', 'numeric', 'max:24'],
        ];
    }
}
