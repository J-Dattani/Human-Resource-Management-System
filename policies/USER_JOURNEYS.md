Authoritative user journey definitions for the Dayflow HRMS project
This document describes step‑by‑step user journeys for each role, strictly aligned with a PHP page‑based architecture (not SPA).
It explains what the user does, what the system does, and how the flow is executed using HTML forms, JavaScript, and PHP.

This file is critical to prevent:

Broken UX flows

Incorrect PHP routing assumptions

Role confusion during implementation

AI hallucination of SPA behavior

1. Purpose of This Document
The purpose of USER_JOURNEYS.md is to:

Define exact user paths through the system

Clarify who can do what and when

Specify client vs server responsibilities

Ensure journeys are implementable using:

HTML forms

Bootstrap layouts

JavaScript for interactivity

PHP for processing and sessions

If a journey is not defined here, it must not be implemented.

2. Supported User Journeys (Overview)
The system supports journeys for exactly two roles:

Employee

Admin / HR Officer

Each journey is:

Linear

Page‑based

Session‑controlled

Role‑restricted

3. Employee User Journeys
3.1 Employee – First‑Time Signup Journey
Goal: Allow an employee to create an account and enter the system.

Steps
User opens signup.php

User fills HTML form:

Employee ID

Email

Password

Role = Employee

User submits form (POST)

PHP validates input (basic validation)

PHP creates mock user session:

$_SESSION['user_id']

$_SESSION['role'] = 'employee'

PHP redirects to employee_dashboard.php

Notes
No real database required

Validation errors are shown inline

Successful signup immediately logs user in

3.2 Employee – Login Journey
Goal: Allow employee to access their dashboard.

Steps
User opens login.php

Enters email + password

Submits form

PHP validates credentials (mock)

PHP sets session

Redirect to employee_dashboard.php

Failure Case
Invalid credentials → error message shown on same page

3.3 Employee – Dashboard Navigation Journey
Goal: Allow employee to access allowed modules.

Steps
Employee lands on employee_dashboard.php

Dashboard shows cards/links:

Profile

Attendance

Leave

Payroll

Logout

Clicking a card loads a new PHP page

Rules
Admin links must not be visible

Direct URL access to admin pages must be blocked via PHP role checks

3.4 Employee – View & Edit Profile Journey
Goal: Allow employee to view profile and edit limited fields.

Steps
Employee clicks Profile

Loads profile.php

Profile data is rendered via PHP

Editable fields:

Address

Phone

Profile picture

User submits update form

PHP validates and updates mock data

Success message displayed

Restrictions
Job role, salary, and designation fields are read‑only

Attempted tampering must be ignored server‑side

3.5 Employee – Attendance Marking Journey
Goal: Allow employee to mark daily attendance.

Steps
Employee clicks Attendance

Loads attendance.php

Attendance table is displayed

Employee clicks Check‑In / Check‑Out

JavaScript handles button state

Form submits to PHP

Attendance status updated

UI refresh shows new status

3.6 Employee – Apply Leave Journey
Goal: Allow employee to apply for leave.

Steps
Employee clicks Leave

Loads leave.php

Clicks Apply Leave

Fills form:

Leave type

Date range

Reason

Submits form

PHP sets leave status = Pending

Confirmation message shown

Post‑Condition
Leave appears in employee leave list

Status visible at all times

3.7 Employee – View Payroll Journey
Goal: Allow employee to view payroll details.

Steps
Employee clicks Payroll

Loads payroll.php

Payroll details rendered (read‑only)

Rules
No editable fields

No calculations performed

3.8 Employee – Logout Journey
Goal: Safely exit the system.

Steps
Employee clicks Logout

PHP destroys session

Redirects to login.php

4. Admin / HR User Journeys
4.1 Admin – Login Journey
Same as employee login, except:

$_SESSION['role'] = 'admin'

Redirects to admin_dashboard.php

4.2 Admin – Dashboard Overview Journey
Goal: Provide overview of HR operations.

Steps
Admin lands on admin_dashboard.php

Dashboard displays:

Employee list

Pending leave requests

Attendance overview

Admin selects an action

4.3 Admin – Manage Employee Profile Journey
Goal: Allow admin to manage employee details.

Steps
Admin clicks Employees

Loads employees.php

Selects an employee

Loads profile.php?id={employee_id}

Admin edits any field

Submits form

PHP updates data

Confirmation shown

4.4 Admin – Attendance Management Journey
Goal: Allow admin to review and modify attendance.

Steps
Admin clicks Attendance

Loads attendance overview

Selects an employee

Edits attendance status

Saves changes

UI updates immediately

4.5 Admin – Leave Approval Journey
Goal: Allow admin to approve or reject leave.

Steps
Admin clicks Leave Requests

Loads leave_requests.php

Views pending requests

Selects a request

Chooses Approve or Reject

Adds optional comment

Submits action

PHP updates leave status

Employee sees updated status

4.6 Admin – Payroll Management Journey
Goal: Allow admin to edit payroll structure.

Steps
Admin clicks Payroll

Loads payroll management page

Selects employee

Edits payroll fields

Saves changes

Updated data is reflected immediately

4.7 Admin – Logout Journey
Same as employee logout:

Session destroyed

Redirect to login

5. Cross‑Journey Rules (Mandatory)
All pages must validate:

User authentication

User role

Unauthorized access must redirect to login

PHP session is the source of truth

JavaScript enhances UX but never replaces PHP checks

6. Error & Edge Case Journeys
The system must handle:

Expired session → redirect to login

Unauthorized page access → redirect + message

Invalid form submission → inline errors

Empty data → friendly empty states

7. Relationship to Other Documents
This document must align with:

APP_FLOW.md

PROJECT_SPEC.md

PROJECT_SCOPE.md

STATE_MODEL.md

CORE_SAFETY.md

If any journey conflicts with another document:

CORE_SAFETY.md has highest priority

8. Enforcement Rule
Any implementation that:

Skips steps defined here

Allows role leakage

Introduces SPA‑style routing

Bypasses PHP session checks

Is invalid and must be corrected.



