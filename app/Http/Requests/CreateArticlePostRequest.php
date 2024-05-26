<?php

namespace App\Http\Requests;

use App\Traits\ThrowJsonValidationErrorTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateArticlePostRequest extends FormRequest
{
    use ThrowJsonValidationErrorTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255', 'unique:articles'],
            'content' => ['required', 'string', 'max:1000'],
        ];
    }
}
