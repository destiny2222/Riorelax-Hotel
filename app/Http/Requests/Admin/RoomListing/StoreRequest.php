<?php

namespace App\Http\Requests\Admin\RoomListing;

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
            'room_title' => ['required', 'string', 'max:255'],
            'room_type' => ['required', 'string', 'max:255'],
            'room_number'=>['required', 'numeric'],
            'room_image' => ['required', 'image'],
            'room_images' => ['required', 'array'],
            'room_images.*' => ['image'],
            'price' => ['required', 'numeric'],
            'description' => ['required', 'string'],
        ];
    }
}
