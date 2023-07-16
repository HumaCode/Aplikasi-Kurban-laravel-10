<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreKurbanPesertaRequest extends FormRequest
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
        return [
            'kurban_id'         => [
                'required',
                Rule::exists('kurbans', 'id')->where('masjid_id', auth()->user()->masjid_id)
            ],
            'nama'              => 'required',
            'nama_tampilan'     => 'required',
            'nohp'              => 'required|numeric',
            'alamat'            => 'nullable',
            'kurban_hewan_id'   => 'nullable',
            'total_bayar'       => 'nullable',
            'tanggal_bayar'     => 'nullable',
            'status_bayar'      => 'nullable',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // nullable
        if ($this->total_bayar != null) {
            $this->merge([
                'total_bayar'             => str_replace('.', '', $this->total_bayar),
            ]);
        }
    }
}
