<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuditRequest extends FormRequest
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
        $rules = [
            'user_id' => 'required',
            'zoho_id' => 'required|unique:evaluations',
            'evaluationStatus' => 'required',
            'comments' => 'required',
        ];
        if ($this->getMethod() == 'PUT') {
            $rules['zoho_id'] = 'required|unique:evaluations,zoho_id,' . $this->audit->id;
        }
        return $rules;
    }
}
