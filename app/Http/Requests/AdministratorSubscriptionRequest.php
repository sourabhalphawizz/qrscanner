<?php

namespace App\Http\Requests;

use App\Rules\IniAmount;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdministratorSubscriptionRequest extends FormRequest
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
            'plan_id'        => ['required', 'numeric'],
            'start_date' => ['required', 'string', 'max:190'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->isNotNull(request('start_date'))) {
                $validator->errors()->add('start_date', 'The start date field is required');
            }
        });
    }

    private function isNotNull($value)
    {
        if ($value === 'null') {
            return false;
        }
        return true;
    }
}
