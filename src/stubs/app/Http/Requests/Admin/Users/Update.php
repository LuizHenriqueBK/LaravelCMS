<?php
namespace App\Http\Requests\Admin\Users;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
            'name' => 'required|min:3|max:255',
            'email' => ['required', 'email:rfc', Rule::unique('users')->ignore($this->route()->user), 'max:255'],
            'status' => 'nullable|in:0,1,true,false',
            'roles' => 'required|array|distinct|min:1',
            'roles.*' => 'required|numeric',
            'avatar' => 'nullable|image|max:5120',
            'password' => 'nullable|present|min:6|alpha_num',
        ];
    }
}
