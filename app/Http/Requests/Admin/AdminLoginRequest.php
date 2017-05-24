<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\AdminRequest;

class AdminLoginRequest extends AdminRequest
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
            'email' => 'required|email|db_exist:admin_users,email',
            'password' => 'required|string',
        ];
    }

    public function messages()
    {
        return $message = [
            'email.db_exist' => 'Please enter the correct email address!',
        ];
    }
}
