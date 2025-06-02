<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'sub_category_id' => ['required', 'exists:sub_categories,id,category_id,' . $this->input('category_id')],
            'assigned_to_user_id' => ['nullable', 'exists:users,id'],
            'status' => ['required', 'string', 'in:pending,in-progress,completed'],
            'due_date' => ['nullable', 'date', 'after_or_equal:today'],
        ];
    }
}
