/**
 * Sidebar Functionality
 * Handles toggle behavior and active state highlighting
 */

document.addEventListener('DOMContentLoaded', () => {

    // --- 1. Toggle Functionality ---
    const sidebarToggle = Utils.select('.sidebar-toggle');
    const sidebar = Utils.select('.dashboard-sidebar');
    const overlay = Utils.select('.sidebar-overlay');

    if (sidebarToggle && sidebar && overlay) {
        const toggleSidebar = () => {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        };

        Utils.on('click', sidebarToggle, toggleSidebar);
        Utils.on('click', overlay, toggleSidebar);
    }

    // --- 2. Active Link Highlighting ---
    const currentPath = window.location.pathname.split('/').pop();
    const navLinks = Utils.select('.nav-link', true);

    if (navLinks) {
        navLinks.forEach(link => {
            const linkPath = link.getAttribute('href');

            // Exact match
            if (linkPath === currentPath) {
                link.classList.add('active');
            }

            // Remove active class if logic dictates (cleaned up from static HTML)
            // If the current page is 'dashboard.php' and the link is 'dashboard.php', add active.
            // But we must remove 'active' from others first if they were hardcoded in PHP.
            // Since we are moving to JS handling, PHP should ideally print links without 'active' class
            // or we blindly trust JS to handle it.
            // Let's ensure only the correct one is active.

            if (linkPath !== currentPath) {
                link.classList.remove('active');
            }
        });
    }
});
