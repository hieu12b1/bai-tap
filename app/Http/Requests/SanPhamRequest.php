<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SanPhamRequest extends FormRequest
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
            'danh_muc_id' => 'required|exists:danh_mucs,id',
            'ten_san_pham' => 'required|max:255',
            'ma_san_pham' => 'required|max:255|unique:san_phams,ma_san_pham,' . $this->route('id'),
            'hinh_anh' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
            'gia_san_pham' => 'required|numeric|min:0',
            'gia_khuyen_mai' => 'numeric|min:0|lt:gia_san_pham',
            'mo_ta_ngan' => 'string|max:255',
            'so_luong' => 'integer|min:0',
            'ngay_nhap' => 'required|date'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'danh_muc_id.required' => 'Danh mục là bắt buộc.',
            'danh_muc_id.exists' => 'Danh mục không hợp lệ.',
            'ten_san_pham.required' => 'Tên sản phẩm là bắt buộc.',
            'ten_san_pham.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',
            'ma_san_pham.required' => 'Mã sản phẩm là bắt buộc.',
            'ma_san_pham.max' => 'Mã sản phẩm không được vượt quá 255 ký tự.',
            'ma_san_pham.unique' => 'Mã sản phẩm đã tồn tại.',
            'hinh_anh.image' => 'Hình ảnh phải là một tệp hình ảnh.',
            'hinh_anh.mimes' => 'Hình ảnh phải có định dạng jpg, jpeg, png, gif.',
            'hinh_anh.max' => 'Hình ảnh không được vượt quá 2MB.',
            'gia_san_pham.required' => 'Giá sản phẩm là bắt buộc.',
            'gia_san_pham.numeric' => 'Giá sản phẩm phải là một số.',
            'gia_san_pham.min' => 'Giá sản phẩm phải lớn hơn hoặc bằng 0.',
            'gia_khuyen_mai.numeric' => 'Giá khuyến mãi phải là một số.',
            'gia_khuyen_mai.min' => 'Giá khuyến mãi phải lớn hơn hoặc bằng 0.',
            'gia_khuyen_mai.lt' => 'Giá khuyến mãi phải nhỏ hơn giá sản phẩm.',
            'mo_ta_ngan.string' => 'Mô tả ngắn phải là một chuỗi ký tự.',
            'mo_ta_ngan.max' => 'Mô tả ngắn không được vượt quá 500 ký tự.',
            'so_luong.integer' => 'Số lượng phải là một số nguyên.',
            'so_luong.min' => 'Số lượng phải lớn hơn hoặc bằng 0.',
            'ngay_nhap.required' => 'Ngày nhập là bắt buộc.',
            'ngay_nhap.date' => 'Ngày nhập phải là một ngày hợp lệ.'
        ];
    }
}
