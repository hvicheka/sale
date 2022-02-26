<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSaleRequest extends FormRequest
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
            "name" => ['string'],
            "purchase_price" => ['numeric'],
            "price" => ['numeric', 'gt:purchase_price'],
            "customer_id" => [Rule::exists('users', 'id')],
            "image" => ['nullable', 'string'],
            "description" => ['string'],
            "note" => ['nullable', 'string'],
        ];
    }
}
