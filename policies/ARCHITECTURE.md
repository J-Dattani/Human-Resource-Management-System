Authoritative system architecture for the Dayflow HRMS project
This document defines how the system is structured, how responsibilities are divided, and how components interact, strictly for a traditional PHP web application.

This file exists to prevent:

Overengineering

SPA/framework assumptions

Misplaced logic (JS doing backend work)

Unclear separation of concerns

If a component or responsibility is not defined here, it must not be introduced.

1. Architecture Overview
Dayflow follows a simple, layered, page‑based architecture:

Browser (UI)
↓
HTML + Bootstrap (Layout)
↓
JavaScript (UX enhancement only)
↓
PHP Pages (Control + Logic)
↓
Mock Data (Arrays / Sessions)
There is no frontend framework, no API layer, and no database.

2. Architectural Principles (Non‑Negotiable)
PHP is the authority

JavaScript is辅助 (supporting), not controlling

Each page is a responsibility boundary

Session = source of truth

Simple > Clever

Demo‑ready > Enterprise‑ready

3. High‑Level Component Breakdown
The system is divided into five major architectural layers:

Presentation Layer (UI)

Client Enhancement Layer (JavaScript)

Server Control Layer (PHP Pages)

Session & State Layer

Mock Data Layer

4. Presentation Layer (HTML + Bootstrap)
4.1 Responsibility
Render UI

Display data

Collect user input

4.2 Characteristics
HTML forms for all actions

Bootstrap for:

Grid

Forms

Buttons

Alerts

No inline business logic

4.3 Rules
HTML must not assume data validity

No role‑based hiding without PHP support

UI must remain functional without JavaScript

5. Client Enhancement Layer (JavaScript)
5.1 Responsibility
JavaScript is used only for:

Form validation (required fields)

Button state toggles

UX improvements (loading indicators)

Minor interactivity

5.2 Forbidden Responsibilities
JavaScript must never:

Decide authentication

Decide authorization

Modify state permanently

Bypass PHP validation

Simulate routing

5.3 Failure Tolerance
If JavaScript fails:

Core flows must still work

PHP remains authoritative

6. Server Control Layer (PHP Pages)
6.1 Responsibility
PHP pages act as controllers + renderers.

Each .php file:

Validates session

Validates role

Handles GET/POST

Updates state

Renders HTML

6.2 Page Categories
Authentication Pages
login.php

signup.php

logout.php

Dashboard Pages
employee_dashboard.php

admin_dashboard.php

Functional Pages
profile.php

attendance.php

leave.php

leave_requests.php

payroll.php

employees.php

6.3 Mandatory Page Structure (Pattern)
Every protected PHP page must follow:

session_start();
require 'auth_guard.php';   // session + role validation
require 'data_source.php'; // mock data
Then:

Handle POST (if any)

Prepare data

Render HTML

7. Session & State Layer
7.1 Responsibility
Store authentication state

Store role

Store temporary user context

7.2 Stored In
$_SESSION
7.3 Allowed Session Data
user_id

role

basic user info

temporary demo data

7.4 Rules
Session must be checked on every page

Logout must destroy session completely

No sensitive or unnecessary data stored

8. Mock Data Layer
8.1 Responsibility
Simulate real data

Support demo flows

8.2 Implementation Options
PHP arrays

Included files (e.g. mock_data.php)

Session‑scoped data

8.3 Rules
No persistence beyond session

Data structures must follow DATA_MODEL.md

No dynamic schema changes

9. Data Flow (Request → Response)
9.1 Typical Flow
User submits form
→ HTTP POST
→ PHP validates session
→ PHP validates role
→ PHP validates input
→ PHP updates mock data
→ PHP reloads page
→ UI reflects updated state
No background jobs.
No async APIs.
No hidden flows.

10. Error Handling Architecture
Errors detected in PHP

Passed to UI via variables

Rendered using Bootstrap alerts

Never exposed via raw PHP output

All error behavior must follow ERROR_SCENARIOS.md.

11. Security Architecture (Baseline)
Session‑based auth

Server‑side role checks

Input validation in PHP

No trust in client input

No sensitive logic in JS

This is demo‑level security, but must be correct and consistent.

12. Scalability & Extensibility (Controlled)
The architecture:

Is intentionally simple

Is not designed for scale

Can be extended only if:

Documented

Approved

Does not violate scope

No premature abstraction allowed.

13. Forbidden Architectural Patterns
The following are strictly forbidden:

SPA architecture

API‑first design

MVC frameworks

State managers

Client‑side routing

Hidden background workers

14. Relationship to Other Documents
This architecture must align with:

APP_FLOW.md

STATE_MODEL.md

DATA_MODEL.md

ERROR_SCENARIOS.md

CORE_SAFETY.md

If conflicts arise:

CORE_SAFETY.md has highest priority

15. Enforcement Rule
Any implementation that:

Moves logic to the wrong layer

Lets JS control authority

Introduces framework assumptions

Breaks page‑based flow

Is invalid and must be corrected.

