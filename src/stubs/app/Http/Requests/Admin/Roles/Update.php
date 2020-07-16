<?php
namespace App\Http\Requests\Admin\Roles;

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
            'title' => 'required|max:50',
            'name' => ['required', Rule::unique('roles')->ignore($this->role), 'max:50'],
            'description' => 'required|max:255',
            'permissions' => 'nullable|array',
            'permissions.*' => 'required|numeric',
        ];
    }
}
