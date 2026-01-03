/**
 * Dayflow HRMS - Authentication UI Logic
 * Handles visual interactions and client-side validation for auth pages.
 */

document.addEventListener('DOMContentLoaded', function () {
    // Password Visibility Toggle
    const toggleButtons = document.querySelectorAll('.toggle-password');

    toggleButtons.forEach(button => {
        button.addEventListener('click', function () {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const iconShow = this.querySelector('.icon-show');
            const iconHide = this.querySelector('.icon-hide');

            if (input.type === 'password') {
                input.type = 'text';
                iconShow.classList.add('d-none');
                iconHide.classList.remove('d-none');
            } else {
                input.type = 'password';
                iconShow.classList.remove('d-none');
                iconHide.classList.add('d-none');
            }
        });
    });

    // Client-side Form Validation
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Clear previous validation errors
            form.querySelectorAll('.validation-error').forEach(el => el.remove());
            form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            
            // Email validation
            const emailInput = form.querySelector('input[type="email"]');
            if (emailInput && emailInput.value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailInput.value.trim())) {
                    showError(emailInput, 'Please enter a valid email address');
                    isValid = false;
                }
            }
            
            // Password validation
            const passwordInput = form.querySelector('input[name="password"]');
            if (passwordInput && passwordInput.hasAttribute('required')) {
                if (passwordInput.value.length === 0) {
                    showError(passwordInput, 'Password cannot be empty');
                    isValid = false;
                }
            }
            
            // Confirm password match validation (signup)
            const confirmInput = form.querySelector('input[name="confirm_password"]');
            if (confirmInput && passwordInput) {
                if (confirmInput.value !== passwordInput.value) {
                    showError(confirmInput, 'Passwords do not match');
                    isValid = false;
                }
            }
            
            // Required fields validation
            form.querySelectorAll('input[required], select[required], textarea[required]').forEach(input => {
                if (!input.value.trim()) {
                    const label = form.querySelector(`label[for="${input.id}"]`);
                    const fieldName = label ? label.textContent : 'This field';
                    showError(input, `${fieldName} is required`);
                    isValid = false;
                }
            });
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    });
    
    // Helper function to show validation error
    function showError(input, message) {
        input.classList.add('is-invalid');
        const errorDiv = document.createElement('div');
        errorDiv.className = 'validation-error text-danger small mt-1';
        errorDiv.textContent = message;
        input.parentNode.appendChild(errorDiv);
    }
    
    // Clear error on input
    document.querySelectorAll('input, select, textarea').forEach(input => {
        input.addEventListener('input', function() {
            this.classList.remove('is-invalid');
            const error = this.parentNode.querySelector('.validation-error');
            if (error) error.remove();
        });
    });
});
