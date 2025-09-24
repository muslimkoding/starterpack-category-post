<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdatePostRequest extends FormRequest
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
            'slug' => Str::slug($this->title)
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $postId = $this->route('post')->id;

        return [
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255|min:5',
            'slug' => 'required|string|max:255',
            'image' => 'nullable|mimes:png,jpg,jpeg,gif,svg|max:2048',
            'content'=> 'required|string',
            'status'=> 'required|in:publish,draft',
            'tags'=> 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Kategori wajib diisi',
            'title.required' => 'Judul wajib diisi',
            'title.max' => 'Maksimal 255 karakter',
            'title.min' => 'Minimal 5 karakter',
            'image.required' => 'Gambar wajib diupload',
            'image.mimes' => 'Hanya menerima gambar berupa png, jpg, jpeg, gif dan svg',
            'image.max' => 'Maksimal ukuran berat gambar 2MB',
            'content.required' => 'Konten wajib diisi',
            'status.required' => 'Status wajib diisi',
        ];
    }
}
