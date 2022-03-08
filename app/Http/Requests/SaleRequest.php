<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaleRequest extends FormRequest
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
            "name" => ['required', 'string'],
            "purchase_price" => ['required'],
            "price" => ['required', 'gt:purchase_price'],
            "customer_id" => ['required', Rule::exists('users', 'id')],
            "description" => ['required', 'string'],
            "date" => ['required', 'date'],
            "note" => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5120'],  // 5MB
        ];
    }
}
