<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules;

class ChangePasswordRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'old_password' => 'required',
            'new_password' => ['required', 'confirmed', Rules\Password::defaults()]
        ];
    }

    /**
     * @throws ValidationException
     */
    public function validatePasswords(string $oldPassword, string $newPassword)
    {
        if($oldPassword === $newPassword){
            throw ValidationException::withMessages([
                'new_password' => [__("The new password can't be the same as your old.")],
            ]);
        }

        if(!Hash::check($oldPassword, auth('sanctum')->user()->password)){
            throw ValidationException::withMessages([
                'old_password' => [__("Old Password doesn't match.")],
            ]);
        }
    }
}
