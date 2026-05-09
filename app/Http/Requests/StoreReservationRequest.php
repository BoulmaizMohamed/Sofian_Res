<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Public — no auth required
    }

    public function rules(): array
    {
        return [
            'full_name'        => ['required', 'string', 'max:255'],
            'phone_number'     => ['required', 'string', 'max:20'],
            'reservation_type' => ['required', 'in:single,group,family,organisation'],
            'num_beds'         => ['required', 'integer', 'min:1'],
            'num_days'         => ['required', 'integer', 'min:1', 'max:30'],
            'date'             => ['required', 'date_format:Y-m-d', 'after_or_equal:yesterday'],
            'notes'            => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'reservation_type.in' => 'Reservation type must be: single, group, family, or organisation.',
            'date.after_or_equal' => 'Reservation date cannot be in the past.',
            'num_days.min'        => 'Minimum stay is 1 day.',
            'num_days.max'        => 'Maximum stay is 30 days.',
        ];
    }
}

