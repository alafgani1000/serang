<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ticketcreatedITRequestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'service_id' => 'required|exists:services,id',
            'business_need' => 'required|max:255',
            'title' => 'required',
            'business_benefit' => 'required|max:255',
            'ticket' => 'required',
        ];
    }
}
