Authoritative application flow definition for the Dayflow HRMS project (PHP page‑based architecture)
This document defines the exact navigation, request/response flow, and control logic of the application using PHP server‑rendered pages, HTML forms, Bootstrap UI, and JavaScript for enhancement only.

This file is the single source of truth for how pages connect and how control flows through the system.

1. Purpose of This Document
APP_FLOW.md exists to:

Define page‑to‑page navigation (not SPA routing)

Clarify PHP vs JavaScript responsibilities

Enforce session‑based access control

Prevent AI or developers from assuming framework behavior

Ensure flows are implementable in pure PHP

If a page transition or action is not described here, it must not exist.

2. Application Architecture Model (Important)
Dayflow uses a traditional PHP web application model:

Each screen = a .php file

Navigation = HTTP requests (GET/POST)

State = PHP sessions ($_SESSION)

UI = HTML + Bootstrap

Interactivity = JavaScript (optional, non‑authoritative)

There is NO client‑side router.

3. Global Application Entry Flow
3.1 Initial Request Flow
User opens application URL
→ index.php
→ Session check
PHP Logic
If $_SESSION['user_id'] exists:

Redirect based on role

Else:

Redirect to login.php

4. Authentication Flow (PHP‑Controlled)
4.1 Login Flow
Pages involved

login.php

login_handler.php (or same file handling POST)

Flow

login.php (GET)
→ User submits form (POST)
→ PHP validates credentials (mock)
→ PHP sets session variables
→ PHP redirects to dashboard
Session Variables Set

$_SESSION['user_id']
$_SESSION['role']  // 'employee' or 'admin'
Failure Case

PHP reloads login.php

Error message shown via Bootstrap alert

4.2 Signup Flow
Pages involved

signup.php

signup_handler.php

Flow

signup.php
→ Form submit (POST)
→ PHP validates input
→ PHP creates mock user session
→ Redirect to appropriate dashboard
Rules

Role selection is mandatory

No database required

Successful signup = logged in

5. Role Resolution & Access Guard Flow
5.1 Role Guard (Mandatory on Every Page)
Every protected page must start with:

session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}
Additionally:

Employee pages must check:

$_SESSION['role'] === 'employee'
Admin pages must check:

$_SESSION['role'] === 'admin'
Unauthorized access must:

Destroy session (optional)

Redirect to login.php

6. Dashboard Flow
6.1 Employee Dashboard Flow
Page

employee_dashboard.php

Flow

login/signup success
→ employee_dashboard.php
→ Employee clicks module link
→ Corresponding PHP page loads
Visible Modules

Profile → profile.php

Attendance → attendance.php

Leave → leave.php

Payroll → payroll.php

Logout → logout.php

Admin links must never be rendered here.

6.2 Admin Dashboard Flow
Page

admin_dashboard.php

Flow

login/signup success
→ admin_dashboard.php
→ Admin selects management action
→ Corresponding PHP page loads
Visible Modules

Employees → employees.php

Attendance → attendance.php

Leave Requests → leave_requests.php

Payroll → payroll.php

Logout → logout.php

7. Profile Module Flow
7.1 Employee Profile Flow
Page

profile.php

Flow

employee_dashboard.php
→ profile.php
→ View profile (PHP render)
→ Edit allowed fields
→ Submit form (POST)
→ PHP updates mock data
→ Page reload with success message
Rules

Salary & job fields are read‑only

PHP must ignore unauthorized field changes

7.2 Admin Profile Flow
Pages

employees.php

profile.php?id={employee_id}

Flow

admin_dashboard.php
→ employees.php
→ Select employee
→ profile.php?id=...
→ Edit any field
→ Submit
→ PHP updates data
8. Attendance Module Flow
8.1 Employee Attendance Flow
Page

attendance.php

Flow

employee_dashboard.php
→ attendance.php
→ View attendance table
→ Click Check‑In / Check‑Out
→ Form submit
→ PHP updates attendance state
→ Page reload
JavaScript:

Button state toggling only

No authority over data

8.2 Admin Attendance Flow
Page

attendance.php

Flow

admin_dashboard.php
→ attendance.php
→ Select employee
→ Edit attendance status
→ Submit
→ PHP saves change
→ Page reload
9. Leave Management Flow
9.1 Employee Leave Flow
Page

leave.php

Flow

employee_dashboard.php
→ leave.php
→ Apply Leave form
→ Submit (POST)
→ PHP sets status = Pending
→ Reload page
Employee can:

View leave history

View approval status

9.2 Admin Leave Approval Flow
Page

leave_requests.php

Flow

admin_dashboard.php
→ leave_requests.php
→ Select request
→ Approve / Reject
→ Submit action
→ PHP updates status + comment
→ Page reload
10. Payroll Flow
10.1 Employee Payroll Flow
Page

payroll.php

Flow

employee_dashboard.php
→ payroll.php
→ PHP renders read‑only payroll data
10.2 Admin Payroll Flow
Page

payroll.php

Flow

admin_dashboard.php
→ payroll.php
→ Select employee
→ Edit payroll fields
→ Submit
→ PHP saves data
→ Reload page
No calculations. No payments.

11. Logout Flow
Page

logout.php

Flow

Any page
→ logout.php
→ session_destroy()
→ Redirect to login.php
Browser back button must not restore session.

12. Error & Invalid Access Flow
Handled entirely by PHP:

Invalid session → redirect to login

Invalid role → redirect to login

Invalid POST → show inline error

Empty data → show empty state UI

13. Forbidden Flow Patterns
The following are strictly forbidden:

Client‑side routing

SPA assumptions

JavaScript‑only access control

Direct page access without PHP checks

Auto‑executing actions on page load

14. Relationship to Other Documents
This flow must align with:

PROJECT_SPEC.md

PROJECT_SCOPE.md

USER_JOURNEYS.md

STATE_MODEL.md

CORE_SAFETY.md

If conflict occurs:

CORE_SAFETY.md overrides all

15. Enforcement Rule
Any implementation that:

Breaks this flow

Skips PHP session checks

Uses SPA‑style logic

Is invalid and must be corrected.

