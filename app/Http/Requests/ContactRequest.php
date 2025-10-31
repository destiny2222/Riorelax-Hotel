<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => 'required|string|max:255|min:2',
            'email' => 'required|email:rfc,dns|max:255',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20|regex:/^[\+]?[0-9\s\-\(\)]{10,20}$/',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:10|max:1000',
            // 'agree_terms_and_policy' => 'required|accepted',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must be at least 2 characters.',
            'name.max' => 'The name must not exceed 255 characters.',
            'email.required' => 'The email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'The email address must not exceed 255 characters.',
            'phone.regex' => 'Please enter a valid phone number format.',
            'phone.max' => 'The phone number must not exceed 20 characters.',
            'subject.max' => 'The subject must not exceed 255 characters.',
            'message.required' => 'The message field is required.',
            'message.min' => 'The message must be at least 10 characters.',
            'message.max' => 'The message must not exceed 1000 characters.',
            // 'agree_terms_and_policy.required' => 'You must agree to the Terms and Privacy Policy.',
            // 'agree_terms_and_policy.accepted' => 'You must agree to the Terms and Privacy Policy.',
        ];
    }

    /**
     * Get custom attribute names for validation errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            // 'agree_terms_and_policy' => 'terms and privacy policy agreement',
        ];
    }
}
