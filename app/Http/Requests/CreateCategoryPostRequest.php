<?php

namespace App\Http\Requests;

use App\Enums\User\UserRole;
use App\Traits\ThrowJsonValidationErrorTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateCategoryPostRequest extends FormRequest
{
    use ThrowJsonValidationErrorTrait;

    public function authorize()
    {
        return Auth::check() && Auth::user()->role === UserRole::Admin->value;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:categories'],
        ];
    }
}
