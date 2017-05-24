<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\AdminRequest;

class UpdateUserRequest extends AdminRequest
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
            'id' => 'required|integer',
            'email' => 'required|email|max:128',
            'name' => 'required|string|max:128',
            'password' => 'string|nullable|min:6',
            'mobile_phone' => 'required|mobile_phone|max:16',
        ];
    }

    public function messages()
    {
        return $message = [
            //
        ];
    }
}
