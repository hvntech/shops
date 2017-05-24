<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'notes' => 'required',
            'datetime' => 'required|datetime_after_now',
            'location' => 'required',
            'fee' => 'required|numeric|min:1',
            'partners_id' => 'required|numeric|min:1',
        ];
    }

    public function messages()
    {
        return $message = [
            'datetime_after_now' => 'Event date must be greater than now.',
        ];
    }
}
