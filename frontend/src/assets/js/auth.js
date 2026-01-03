/**
 * Dayflow HRMS - Authentication UI Logic
 * Handles visual interactions for auth pages.
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
});
