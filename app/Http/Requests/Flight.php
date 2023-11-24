<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Flight extends FormRequest
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

        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'offer_id' => 'required|unique:flights',
                    'caree' => 'nullable',
                    'total_fare' => 'required|numeric|min:0',
                    'currency' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'offer_id' => 'required|unique:flights,offer_id,' . $this->flight,
                    'caree' => 'nullable',
                    'total_fare' => 'required|numeric|min:0',
                    'currency' => 'required',
                ];

            }
            default:break;
        }


    }





}
