<?php

namespace App\Http\Requests\Produk;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'foto'           => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'name'           => 'required|string|max:255',
            // Batasi maksimal nilai harga hingga Rp 2.000.000.000 (2 Miliar) agar muat di integer DB
            'purchase_price' => 'required|integer|min:0|max:2000000000',
            'selling_price'  => 'required|integer|min:0|max:2000000000',
            'stock'          => 'required|integer|min:0|max:999999',
        ];
    }

    public function messages(): array
    {
        return [
            'foto.required'           => 'Foto produk wajib diunggah!',
            'foto.image'              => 'File yang diupload harus gambar.',
            'foto.mimes'              => 'Extensi gambar harus JPG, JPEG, PNG, WEBP.',
            'foto.max'                => 'Maksimal ukuran gambar 2MB.',
            
            'name.required'           => 'Nama wajib diisi.',
            'name.max'                => 'Nama maksimal 255 karakter.',

            'purchase_price.required' => 'Harga beli wajib diisi.',
            'purchase_price.integer'  => 'Harga beli harus diisi bilangan bulat.',
            'purchase_price.max'      => 'Harga beli terlalu besar (Maksimal Rp 2.000.000.000).',

            'selling_price.required'  => 'Harga jual wajib diisi.',
            'selling_price.integer'   => 'Harga jual harus diisi bilangan bulat.',
            'selling_price.max'       => 'Harga jual terlalu besar (Maksimal Rp 2.000.000.000).',

            'stock.required'          => 'Stok wajib diisi.',
            'stock.integer'           => 'Stok harus diisi angka.',
            'stock.max'               => 'Stok terlalu besar (Maksimal 999.999).',
        ];
    }
}