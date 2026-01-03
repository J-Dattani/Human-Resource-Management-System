Authoritative definition of component‑level responsibilities for the Dayflow HRMS project
This document defines what each component (page, file, and layer) is responsible for and what it must NEVER do, strictly aligned with a HTML / CSS / Bootstrap / JavaScript / PHP architecture.

This file exists to:

Prevent responsibility overlap

Avoid logic leakage across layers

Stop AI or developers from inventing new roles for components

Ensure the system stays simple, debuggable, and demo‑ready

If a responsibility is not explicitly assigned here, it must not be assumed.

1. Responsibility Assignment Principles (Mandatory)
The following principles apply to all components:

Every responsibility has one clear owner

No responsibility is shared implicitly

PHP is the authority layer

JavaScript is supportive only

UI components never decide business logic

Pages do not perform unrelated tasks

Violating these principles is considered a design error.

2. High‑Level Responsibility Map
Layer	Primary Responsibility
Presentation (HTML)	Structure & input collection
Styling (Bootstrap/CSS)	Layout & visual clarity
JavaScript	UX enhancement only
PHP Pages	Control, validation, state changes
Session Layer	Auth & role state
Mock Data Layer	Simulated data storage
3. Page‑Level Component Responsibilities (PHP Files)
3.1 login.php
Responsible for

Rendering login form

Accepting login POST data

Validating credentials (mock)

Creating authentication session

Redirecting user based on role

Must NOT

Contain UI for other modules

Assume role before validation

Perform client‑side only login

3.2 signup.php
Responsible for

Rendering signup form

Validating required fields

Assigning role

Creating session on success

Redirecting to correct dashboard

Must NOT

Auto‑assign roles

Skip validation

Persist real user data

3.3 logout.php
Responsible for

Destroying PHP session

Clearing all user state

Redirecting to login.php

Must NOT

Render UI

Retain any user data

3.4 employee_dashboard.php
Responsible for

Rendering employee‑only navigation

Linking to employee modules

Displaying high‑level summaries (optional)

Must NOT

Show admin links

Perform data mutations

Bypass role checks

3.5 admin_dashboard.php
Responsible for

Rendering admin navigation

Linking to management modules

Displaying admin summaries

Must NOT

Render employee‑only views

Perform background logic

3.6 profile.php
Responsible for

Displaying profile data

Handling profile update form

Enforcing field‑level permissions

Must NOT

Allow unauthorized field updates

Infer role from UI

Modify unrelated data

3.7 attendance.php
Responsible for

Displaying attendance records

Handling attendance updates

Enforcing ownership rules

Must NOT

Allow cross‑employee edits by employees

Accept invalid attendance states

3.8 leave.php
Responsible for

Rendering leave application form

Submitting leave requests

Displaying leave history and status

Must NOT

Allow editing after submission

Change leave approval state

3.9 leave_requests.php
Responsible for

Displaying pending leave requests

Accepting approve/reject actions

Recording admin comments

Must NOT

Allow employee access

Revert finalized leave states

3.10 payroll.php
Responsible for

Displaying payroll data

Allowing admin edits

Enforcing read‑only view for employees

Must NOT

Perform payroll calculations

Allow employee edits

3.11 employees.php
Responsible for

Listing employees

Linking to individual profiles (admin)

Must NOT

Perform profile edits directly

Be accessible to employees

4. PHP Helper / Include Components
4.1 auth_guard.php
Responsible for

Validating session existence

Validating role access

Redirecting unauthorized users

Must NOT

Render UI

Modify data

Perform redirects unrelated to auth

4.2 mock_data.php
Responsible for

Providing mock data structures

Ensuring consistent demo data

Must NOT

Contain logic

Modify session state directly

5. JavaScript Component Responsibilities
5.1 main.js
Responsible for

Client‑side form validation

Button state toggles

UI feedback (loading, disabling)

Must NOT

Decide authentication

Decide authorization

Persist data

Modify server state directly

JavaScript failure must not break core flows.

6. HTML Component Responsibilities
Responsible for

Structuring content

Collecting user input

Displaying messages and data

Must NOT

Contain business rules

Encode role logic without PHP support

7. CSS / Bootstrap Responsibilities
Responsible for

Responsive layout

Visual hierarchy

Accessibility support

Must NOT

Hide security‑critical UI without PHP

Encode logic via visibility tricks

8. Session Layer Responsibilities
Responsible for

Authentication state

Role state

Temporary demo data

Must NOT

Store unnecessary or sensitive data

Persist beyond logout

9. Data Ownership Rules (Critical)
Data Type	Owner
Auth state	PHP session
Role	PHP session
Attendance	PHP
Leave status	PHP (Admin only)
Payroll	PHP (Admin only)
JavaScript never owns data.

10. Cross‑Component Interaction Rules
UI → PHP via HTTP requests

PHP → UI via rendered HTML

JS → UI only

JS → PHP only via form submission

No other interaction paths are allowed.

11. Forbidden Responsibility Patterns
The following are strictly forbidden:

PHP pages doing multiple unrelated jobs

JavaScript mutating business data

UI deciding access rights

Hidden logic in CSS

Implicit responsibilities

12. Relationship to Other Documents
This document must align with:

ARCHITECTURE.md

FRONTEND_ARCHITECTURE.md

APP_FLOW.md

STATE_MODEL.md

DATA_MODEL.md

CORE_SAFETY.md

If conflicts arise:

CORE_SAFETY.md has highest priority

13. Enforcement Rule
Any implementation that:

Blurs responsibilities

Moves logic to the wrong layer

Introduces undocumented behavior

Violates ownership rules

Is invalid and must be corrected.