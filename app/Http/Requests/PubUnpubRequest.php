<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PubUnpubRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'status' => 'required|boolean',
        ];
    }
}
