<?php

namespace App\Http\Requests\Support;

use Illuminate\Foundation\Http\FormRequest;

class CreateSupportRequest extends FormRequest
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
            'lesson_id' => 'required|exists:lessons,id',
            'description' => 'required|string|min:3|max:10000',
        ];
    }
}
