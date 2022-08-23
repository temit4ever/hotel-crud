<?php

namespace App\ValidationRules;

trait HotelValidationRules
{
    public function rules(): array
    {
        return [
            'hotelName' => [
                'required',
                'string',
            ],
            'hotelAddress' => [
                'required',
                'string',
            ],
            'hotelCity' => [
                'required',
                'string',
            ],
            'hotelStar' => [
                'required',
                'numeric',
            ],
            'hotelDescription' => [
                'required',
                'string',
            ],
            'hotelImage' => [
                'required',
                'mimes:jpeg,png,jpg,gif',
                'max:5000'
            ],
        ];
    }
}
