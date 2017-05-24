<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\AdminRequest;

class AdminStoreUserRequest extends AdminRequest
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
            'email' => 'required|email|max:128|unique:users,email',
            'name' => 'required|string|max:128',
            'password' => 'required|string|min:6',
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
