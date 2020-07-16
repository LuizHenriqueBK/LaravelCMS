<?php
namespace App\Http\Requests\Admin\Roles;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
            'title' => 'required|max:50',
            'name' => 'required|unique:roles|max:50',
            'description' => 'required|max:255',
            'permissions' => 'required|array|min:1',
            'permissions.*' => 'required|numeric',
        ];
    }
}
