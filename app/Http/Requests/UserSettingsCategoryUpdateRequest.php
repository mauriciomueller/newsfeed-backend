<?php

namespace App\Http\Requests;

class UserSettingsCategoryUpdateRequest extends CustomFormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'settings_categories_codes' => 'required|array',
            'settings_categories_codes.*' => 'required|string',
        ];
    }
}
