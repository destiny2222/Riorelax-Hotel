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
        this.attachPhoneValidation();
        this.attachNameValidation();
        this.attachPasswordValidation();
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

    // Phone number validation
    validatePhone(phone) {
        if (!phone || phone.trim() === '') return { valid: true, message: '' }; // Optional field
        
        // Remove all non-numeric characters except + for international
        const cleanPhone = phone.replace(/[^\d+]/g, '');
        
        // Basic length check
        if (cleanPhone.length < 10 || cleanPhone.length > 15) {
            return { valid: false, message: 'Phone number must be between 10-15 digits.' };
        }
        
        // International format check
        const phoneRegex = /^[\+]?[1-9]\d{1,14}$/;
        if (!phoneRegex.test(cleanPhone)) {
            return { valid: false, message: 'Please enter a valid phone number.' };
        }

        return { valid: true, message: '' };
    }

    // Name validation
    validateName(name, required = true) {
        if (!name || name.trim() === '') {
            return required ? { valid: false, message: 'Name is required.' } : { valid: true, message: '' };
        }
        
        if (name.length < 2) return { valid: false, message: 'Name must be at least 2 characters.' };
        if (name.length > 255) return { valid: false, message: 'Name must not exceed 255 characters.' };
        
        // Check for valid characters (letters, spaces, some special chars)
        const nameRegex = /^[a-zA-Z\s\-'\.]+$/;
        if (!nameRegex.test(name)) {
            return { valid: false, message: 'Name can only contain letters, spaces, hyphens, and apostrophes.' };
        }

        return { valid: true, message: '' };
    }

    // Password validation
    validatePassword(password, minLength = 8) {
        if (!password || password.trim() === '') return { valid: false, message: 'Password is required.' };
        if (password.length < minLength) return { valid: false, message: `Password must be at least ${minLength} characters.` };
        
        // Check for at least one number, one lowercase, one uppercase letter
        if (!/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/.test(password)) {
            return { valid: false, message: 'Password must contain at least one uppercase letter, one lowercase letter, and one number.' };
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

    // Attach real-time phone validation
    attachPhoneValidation() {
        $(document).on('input blur', 'input[type="tel"], input[name="phone"]', (e) => {
            const $field = $(e.target);
            const phone = $field.val().trim();
            const validation = this.validatePhone(phone);
            
            this.updateFieldValidation($field, validation);
        });
    }

    // Attach real-time name validation
    attachNameValidation() {
        $(document).on('input blur', 'input[name="name"], input[name="first_name"], input[name="last_name"]', (e) => {
            const $field = $(e.target);
            const name = $field.val().trim();
            const required = $field.prop('required');
            const validation = this.validateName(name, required);
            
            this.updateFieldValidation($field, validation);
        });
    }

    // Attach real-time password validation
    attachPasswordValidation() {
        $(document).on('input blur', 'input[type="password"]', (e) => {
            const $field = $(e.target);
            const password = $field.val();
            const validation = this.validatePassword(password);
            
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

        // Validate phone fields
        $form.find('input[type="tel"], input[name="phone"]').each((index, element) => {
            const $field = $(element);
            const phone = $field.val().trim();
            const validation = this.validatePhone(phone);
            
            if (!validation.valid) {
                this.updateFieldValidation($field, validation);
                errors.push(`Phone: ${validation.message}`);
                isValid = false;
            }
        });

        // Validate name fields
        $form.find('input[name="name"], input[name="first_name"], input[name="last_name"]').each((index, element) => {
            const $field = $(element);
            const name = $field.val().trim();
            const required = $field.prop('required');
            const validation = this.validateName(name, required);
            
            if (!validation.valid) {
                this.updateFieldValidation($field, validation);
                errors.push(`Name: ${validation.message}`);
                isValid = false;
            }
        });

        // Validate password fields
        $form.find('input[type="password"]').each((index, element) => {
            const $field = $(element);
            const password = $field.val();
            const validation = this.validatePassword(password);
            
            if (!validation.valid) {
                this.updateFieldValidation($field, validation);
                errors.push(`Password: ${validation.message}`);
                isValid = false;
            }
        });

        // Validate required fields
        $form.find('input[required], textarea[required], select[required]').each((index, element) => {
            const $field = $(element);
            const value = $field.val();
            
            if (!value || (typeof value === 'string' && value.trim() === '')) {
                $field.addClass('is-invalid');
                const fieldName = $field.attr('name') || $field.attr('id') || 'Field';
                errors.push(`${fieldName} is required.`);
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