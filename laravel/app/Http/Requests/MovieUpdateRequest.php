<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class MovieRequest
 * @package App\Http\Requests
 */
class MovieUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'description' => 'required',
            'image' => 'image',
            'genres' => 'required|array',
            'country' => 'required|string'
        ];
    }
}
