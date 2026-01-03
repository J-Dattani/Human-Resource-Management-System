Authoritative frontend architecture specification for the Dayflow HRMS project
This document defines how the frontend is structured, how UI responsibilities are divided, and how frontend code must interact with PHP, strictly for a non‑SPA, page‑based architecture.

This file exists to prevent:

Mixing backend logic into UI

SPA or framework assumptions

Inconsistent UI behavior

JavaScript becoming authoritative

If a frontend pattern is not defined here, it must not be used.

1. Frontend Architecture Overview
Dayflow uses a traditional server‑rendered frontend:

PHP (renders HTML)
↓
HTML Structure
↓
Bootstrap (layout + components)
↓
CSS (custom styling)
↓
JavaScript (UX enhancement only)
There is no frontend framework, no virtual DOM, and no client‑side routing.

2. Core Frontend Principles (Mandatory)
PHP controls what is rendered

HTML defines structure

Bootstrap defines layout and components

CSS customizes appearance

JavaScript enhances UX, never controls logic

Every page must work without JavaScript

3. Page‑Based Frontend Model
3.1 Page Definition
Each frontend screen corresponds to a single PHP file, such as:

login.php

signup.php

employee_dashboard.php

admin_dashboard.php

profile.php

attendance.php

leave.php

payroll.php

There is no dynamic page swapping.

3.2 Page Lifecycle
HTTP Request
→ PHP validates session & role
→ PHP prepares data
→ PHP renders HTML
→ Browser displays page
→ JavaScript enhances interaction (optional)
4. HTML Structure Rules
4.1 Semantic Structure (Required)
Each page must follow a clear structure:

<header>   <!-- Navigation / Branding --> </header>
<main>     <!-- Page content --> </main>
<footer>   <!-- Optional --> </footer>
Rules:

No deeply nested divs without reason

Use semantic tags where possible

Forms must use proper <form> elements

4.2 Forms
All user actions must be triggered via:

<form method="POST">

<button type="submit">

No JavaScript‑only submissions

Each form must:

Have a clear action

Handle validation feedback

5. Bootstrap Usage Rules
5.1 Layout
Bootstrap must be used for:

Grid system (container, row, col-*)

Responsive behavior

Alignment and spacing utilities

Rules:

No custom grid system

No fixed widths that break responsiveness

Layout must adapt from ~200px width upwards

5.2 Components
Allowed Bootstrap components:

Buttons

Forms

Tables

Cards

Alerts

Modals (optional, UX only)

Forbidden:

JS‑heavy Bootstrap plugins for core logic

Components that hide required actions

6. Custom CSS Rules
6.1 Purpose of Custom CSS
Custom CSS is allowed only for:

Branding

Minor visual tweaks

Overrides not possible via Bootstrap utilities

6.2 CSS Organization
One main stylesheet (e.g. styles.css)

No inline CSS for logic

No page‑specific CSS unless unavoidable

Rules:

CSS must not encode business rules

CSS must not hide role‑restricted actions without PHP backing

7. JavaScript Architecture
7.1 JavaScript Scope
JavaScript is used for:

Client‑side form validation

Button enable/disable

Loading indicators

UI toggles (e.g., show/hide sections)

7.2 JavaScript Boundaries (Strict)
JavaScript must never:

Determine authentication state

Determine authorization

Persist real data

Simulate routing

Bypass PHP validation

PHP always has the final authority.

7.3 JS Failure Handling
If JavaScript fails:

Forms must still submit

Pages must still load

Core functionality must remain usable

8. Role‑Based UI Rendering
8.1 PHP‑Controlled Visibility
Role‑specific UI elements must be controlled by PHP:

if ($_SESSION['role'] === 'admin') {
  // render admin UI
}
Rules:

JavaScript must not decide role visibility

Hidden UI must not be accessible via direct URL

9. Navigation Architecture
9.1 Navigation Structure
Navigation menus rendered by PHP

Links point to .php pages

Active state highlighted via PHP logic

9.2 Navigation Rules
No dynamic route changes

No hash‑based routing

No client‑side page swapping

Each navigation action triggers a full page request.

10. Data Display Patterns
10.1 Tables
Use Bootstrap tables

Must handle:

Empty states

Long content

Small screens (scroll/stack)

10.2 Forms
Labels must be explicit

Required fields marked clearly

Errors displayed near fields

11. Error Display in UI
Errors are passed from PHP to UI

Displayed using Bootstrap alerts

No raw PHP errors visible

No console‑only errors

All error behavior must align with ERROR_SCENARIOS.md.

12. Accessibility & Responsiveness (Baseline)
Frontend must ensure:

Clickable elements are reachable

Text is readable on small screens

Forms usable via keyboard

No layout breaks between 200–400px widths

13. File & Asset Organization (Frontend)
Recommended structure:

/assets
  /css
    styles.css
  /js
    main.js
Rules:

No inline JS for core logic

No mixing PHP logic into JS files

14. Forbidden Frontend Patterns
The following are strictly forbidden:

SPA behavior

Client‑side state managers

JS‑only form handling

Framework‑style components

Logic hidden in CSS or JS

15. Relationship to Other Documents
This frontend architecture must align with:

ARCHITECTURE.md

APP_FLOW.md

STATE_MODEL.md

DATA_MODEL.md

ERROR_SCENARIOS.md

CORE_SAFETY.md

If conflicts arise:

CORE_SAFETY.md has highest priority

16. Enforcement Rule
Any frontend implementation that:

Lets JS control authority

Breaks page‑based flow

Assumes SPA behavior

Violates role‑based rendering

Is invalid and must be corrected.

