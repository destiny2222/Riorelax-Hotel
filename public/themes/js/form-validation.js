/**
 * Enhanced Form Validation Utilities
 * Provides client-side validation for common form fields
 */

class FormValidator {
    constructor() {
        this.init();
    }

    init() {
        this.attachEmailValidation();
    }

    // Email validation with multiple format checks
    validateEmail(email) {
        // More comprehensive email regex
        const emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
        
        // Basic checks
        if (!email || email.trim() === '') return { valid: false, message: 'Email is required.' };
        if (email.length > 320) return { valid: false, message: 'Email address is too long.' };
        if (!emailRegex.test(email)) return { valid: false, message: 'Please enter a valid email address.' };
        
        // Additional checks
        const parts = email.split('@');
        if (parts.length !== 2) return { valid: false, message: 'Invalid email format.' };
        
        const [localPart, domain] = parts;
        if (localPart.length > 64) return { valid: false, message: 'Email local part is too long.' };
        if (domain.length > 255) return { valid: false, message: 'Email domain is too long.' };
        
        // Check for consecutive dots
        if (email.includes('..')) return { valid: false, message: 'Email cannot contain consecutive dots.' };
        
        // Check for valid domain
        if (!domain.includes('.') || domain.startsWith('.') || domain.endsWith('.')) {
            return { valid: false, message: 'Invalid email domain.' };
        }

        return { valid: true, message: '' };
    }

    // Attach real-time email validation
    attachEmailValidation() {
        $(document).on('input blur', 'input[type="email"]', (e) => {
            const $field = $(e.target);
            const email = $field.val().trim();
            const validation = this.validateEmail(email);
            
            this.updateFieldValidation($field, validation);
        });
    }

    // Update field validation state
    updateFieldValidation($field, validation) {
        let $feedback = $field.siblings('.invalid-feedback');
        
        if (validation.valid) {
            $field.removeClass('is-invalid').addClass('is-valid');
            $feedback.hide();
        } else {
            $field.removeClass('is-valid').addClass('is-invalid');
            
            if ($feedback.length === 0) {
                $field.after(`<div class="invalid-feedback d-block text-danger">${validation.message}</div>`);
            } else {
                $feedback.text(validation.message).show();
            }
        }
    }

    // Validate entire form
    validateForm($form) {
        let isValid = true;
        const errors = [];

        // Validate email fields
        $form.find('input[type="email"]').each((index, element) => {
            const $field = $(element);
            const email = $field.val().trim();
            const validation = this.validateEmail(email);
            
            if (!validation.valid) {
                this.updateFieldValidation($field, validation);
                errors.push(`Email: ${validation.message}`);
                isValid = false;
            }
        });

        return { valid: isValid, errors: errors };
    }
}

// Initialize validator when DOM is ready
$(document).ready(function() {
    window.formValidator = new FormValidator();
    
    // Attach form submission validation to all forms with validation class
    $(document).on('submit', 'form.validate, form[data-validate="true"]', function(e) {
        const $form = $(this);
        const validation = window.formValidator.validateForm($form);
        
        if (!validation.valid) {
            e.preventDefault();
            
            // Show error messages
            if (typeof toastr !== 'undefined') {
                toastr.error('Please correct the errors in the form before submitting.');
            } else if (typeof alert !== 'undefined') {
                alert('Please correct the errors in the form before submitting.');
            }
            
            // Focus on first invalid field
            $form.find('.is-invalid').first().focus();
            
            return false;
        }
    });
});