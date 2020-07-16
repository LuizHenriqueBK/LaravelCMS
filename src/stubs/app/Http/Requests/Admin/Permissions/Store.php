<?php
namespace App\Http\Requests\Admin\Permissions;

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
            'name' => 'required|unique:permissions|max:50',
            'description' => 'required|max:255',
        ];
    }
}
