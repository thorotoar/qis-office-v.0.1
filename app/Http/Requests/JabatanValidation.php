<?php

namespace App\Http\Requests;

use http\Env\Request;
use App\Jabatan;
use Illuminate\Foundation\Http\FormRequest;

class JabatanValidation extends FormRequest
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
    public function rules(Request $request)
    {
        $id = Jabatan::find($request->id);
        return [
            'jabatan' => "required|unique:jabatans,nama_jabatan,$id",
        ];
    }

    public function messages()
    {
        return [
            'jabatan.unique' => 'Jabatan yang anda tambahkan sudah tersedia, masukan jabatan lain!.',
        ];
    }
}
