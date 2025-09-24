<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->name)
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $categoryId = $this->route('category')->id; //mengambil id category dari route
        return [
            'name' => ['required', 'string', 'max:255', 'min:3', Rule::unique('categories')->ignore($categoryId)],
            'slug' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama kategori wajib di isi.',
            'name.min' => 'Nama kategori minimal 3 huruf.',
        ];
    }
}
