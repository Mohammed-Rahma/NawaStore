<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $product = $this->route('product' , 0);

        return [
            'name' => 'required|max:255|min:3',
            'slug' => "required|unique:products,slug,$product->id",
            'category_id' => 'nullable|int|exists:categories,id',
            'description' => 'nullable|string',
            'short_description' => 'string|max:500',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0|gt:price',       //gt = greater than  // gte = greater than or equal =
            'image' => 'nullable|image|dimensions:min_width=400,min_height=300,|max:500',   // 500KB  // 1024KB = 1MB
            // 'image' => 'file|mimetypes:image/png,image/jpg,image/jpeg,image/gif',   /// more secure than mimes and it used for imaes/files/videos
            'status'=>'required|in:active,draft,archived',
      ];
    }
    public function messages():array {
        return [
            'name.required'=>'name is required',
            'required'=>':attribute field is required',
            'unique'=>'the value alredy exsits ! '
        ];
    }
    


}
