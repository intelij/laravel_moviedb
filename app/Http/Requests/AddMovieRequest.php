<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class AddMovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return User::author();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'runtime' => 'nullable|integer',
            'released' => 'nullable|date',
            'director' => 'nullable|string',
            'plot' => 'nullable|string',
            'poster' => 'nullable|url',
            'country' => 'nullable|string',
            'language' => 'nullable|string',
            'imdbRating' => 'nullable|between:0,10.0',
            'boxOffice' => 'nullable|numeric',
            'production' => 'nullable|string',
            'rated' => 'nullable|string',
            'awards' => 'nullable|string',
            'website' => 'nullable|url',
            'imbdId' => 'nullable|string'
        ];
    }
}
