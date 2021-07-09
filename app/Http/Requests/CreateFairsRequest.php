<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFairsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:1|max:30',
            'pmsp_code' => 'required|string|min:6|max:6|unique:fairs,pmsp_code',
            'address.number' => 'nullable|numeric|digits_between:1,5',
            'address.street' => 'string|min:1|max:34',
            'address.neighborhood' => 'string|min:1|max:20',
            'address.reference_point' => 'string|min:1|max:24',
            'address.longitude' => 'required|numeric|between:-90,90',
            'address.latitude' => 'required|numeric|between:-90,90',
            'address.district_id' => 'integer|required|exists:districts,id',
            'address.census_area_id' => 'integer|required|exists:census_areas,id',
        ];
    }
}
