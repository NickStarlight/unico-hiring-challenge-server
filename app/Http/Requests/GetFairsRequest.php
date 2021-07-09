<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetFairsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string>
     */
    public function rules()
    {
        return [
            'name' => 'string|max:30',
            'district' => 'string|exists:districts,name',
            'quinary_region_name' => 'string|max:6',
            'neighborhood' => 'string|max:20',
        ];
    }
}
