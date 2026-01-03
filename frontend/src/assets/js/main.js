/**
 * Main Application Script
 * Initializes global behaviors
 */

document.addEventListener('DOMContentLoaded', () => {
    // Initialize tooltips if Bootstrap is present
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
