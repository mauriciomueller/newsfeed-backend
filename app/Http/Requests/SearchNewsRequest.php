<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchNewsRequest extends FormRequest
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
            'q' => 'string',
            'category' => 'string',
            'sources' => ['sometimes', 'required', 'string', function ($attribute, $value, $fail) {
                $sources = explode(',', $value);
                if (count($sources) > 20) {
                    $fail('Maximum of 20' . $attribute . ' allowed');
                }
            }],
            'date' => 'string'
        ];
    }
}
