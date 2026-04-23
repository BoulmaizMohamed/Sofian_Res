<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Guard handled by middleware
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'in:pending,confirmed,cancelled'],
        ];
    }

    public function messages(): array
    {
        return [
            'status.in' => 'Status must be one of: pending, confirmed, cancelled.',
        ];
    }
}
