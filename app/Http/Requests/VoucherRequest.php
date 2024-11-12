<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoucherRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'san_pham_id' => 'required|exists:san_phams,id',
            'discount_amount' => 'required|numeric',
            'end_date' => 'required|date|after:start_date',
            'start_date' => 'required|date',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'discount_amount.required' => 'Discount amount mục bắt buộc điền',
            'discount_amount.numeric' => 'Discount amount phải là một số.',
            'start_date.required' => 'Start date là bắt buộc',
            'end_date.required' => 'End date danh là bắt buộc',
            'end_date.after' => 'End date phải sau Start date.'
        ];
    }
}
