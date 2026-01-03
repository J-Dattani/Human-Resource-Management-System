Authoritative coding standards for the Dayflow HRMS project
This document defines mandatory coding rules, conventions, and constraints for all contributors (human or AI).
Its purpose is to ensure the codebase remains clean, readable, predictable, and demo‑ready within a hackathon timeframe.

If a piece of code violates this document, it is considered incorrect, even if it “works”.

1. Purpose of This Document
CODING_STANDARDS.md exists to:

Enforce consistency across the codebase

Prevent messy or unreadable code

Avoid overengineering and framework‑like patterns

Make the project easy to understand under pressure

Ensure AI‑generated code matches human expectations

These standards apply to all files: PHP, HTML, CSS, and JavaScript.

2. Global Coding Principles (Non‑Negotiable)
The following principles apply everywhere:

Clarity over cleverness

Readability over brevity

Simplicity over abstraction

Predictability over flexibility

Demo‑ready over production‑grade

If there is a doubt, choose the simpler option.

3. PHP Coding Standards
3.1 PHP Style Rules
Use procedural PHP, not frameworks

No complex class hierarchies

Use meaningful variable names

One responsibility per file

Allowed

$userRole = $_SESSION['role'];
Forbidden

$r = $_SESSION['r'];
3.2 PHP File Structure (Mandatory Pattern)
Each PHP page must follow this order:

<?php
session_start();
require 'auth_guard.php';
require 'mock_data.php';

// Handle POST logic here

// Prepare data for UI
?>

<!-- HTML starts here -->
Rules:

No HTML before PHP session checks

No business logic after HTML starts

No hidden logic in includes

3.3 PHP Naming Conventions
Variables: snake_case

Files: snake_case.php

Functions (if used): snake_case()

Examples:

$employee_id
$leave_status
calculate_attendance()
3.4 PHP Logic Rules
Validate everything server‑side

Never trust $_POST or $_GET

Always check:

Authentication

Role

Ownership

Forbidden:

Silent failures

Suppressing errors

Magic behavior

4. HTML Coding Standards
4.1 HTML Structure Rules
Use semantic tags:

<header>, <main>, <footer>

Indentation must be consistent (2 or 4 spaces)

Close all tags properly

4.2 Forms (Mandatory Rules)
Every action must use <form>

Every form must specify:

method="POST"

Clear submit button

Forbidden:

JavaScript‑only submissions

Hidden form actions without PHP validation

4.3 Accessibility Basics
Every input must have a <label>

Buttons must have readable text

No clickable divs for core actions

5. Bootstrap Usage Standards
5.1 Grid & Layout
Use Bootstrap grid for layout

No custom grid system

Avoid fixed widths

Allowed:

<div class="container">
  <div class="row">
    <div class="col-md-6">
Forbidden:

<div style="width: 900px">
5.2 Bootstrap Components
Allowed:

Buttons

Cards

Tables

Alerts

Forms

Forbidden:

Over‑customized components

JS‑heavy plugins for core logic

6. CSS Coding Standards
6.1 CSS Scope
CSS is allowed only for:

Branding

Minor visual tweaks

Bootstrap overrides

6.2 CSS Rules
One main stylesheet (styles.css)

No inline styles for logic

No hiding critical UI via CSS

Forbidden:

.admin-only { display: none; }
(Role visibility must be handled by PHP)

7. JavaScript Coding Standards
7.1 JavaScript Role (Strict)
JavaScript may be used for:

Form validation

Button state changes

UI feedback

JavaScript must never:

Decide authentication

Decide authorization

Persist real data

Replace PHP logic

7.2 JavaScript Style Rules
Use plain JavaScript (ES5/ES6)

One main file (main.js)

Clear function names

No global state pollution

Allowed:

function validateForm() { }
Forbidden:

window.appState = {}
7.3 JS Failure Tolerance
If JavaScript fails:

Forms must still submit

PHP must still process requests

App must remain usable

8. Commenting Standards
8.1 When to Comment
Comments are required when:

Logic is not obvious

Validation rules exist

Edge cases are handled

8.2 Comment Style
Short, clear, and factual

No narrative or jokes

Good:

// Prevent employee from editing salary
Bad:

// This weird thing fixes stuff somehow
9. Error Handling Standards
Errors must be handled in PHP

Displayed using Bootstrap alerts

Never expose:

Stack traces

File paths

Raw PHP warnings

Error handling must follow ERROR_SCENARIOS.md.

10. Forbidden Coding Practices (Critical)
The following are strictly forbidden:

Framework‑like abstractions

Copy‑pasted code without understanding

Dead code

Commented‑out logic

Debug prints (var_dump, print_r) in final code

Console‑only error handling

11. AI‑Generated Code Rules
Any AI‑generated code must:

Follow this document strictly

Match existing style and patterns

Avoid introducing new paradigms

Be readable by a beginner

If AI output violates standards, it must be rewritten.

12. Relationship to Other Documents
This document must align with:

ARCHITECTURE.md

FRONTEND_ARCHITECTURE.md

COMPONENT_RESPONSIBILITIES.md

ERROR_SCENARIOS.md

CORE_SAFETY.md

If conflicts arise:

CORE_SAFETY.md has highest priority

13. Enforcement Rule
Any code that:

Violates these standards

Reduces readability

Introduces unnecessary complexity

Breaks architectural boundaries

Is invalid and must be corrected.