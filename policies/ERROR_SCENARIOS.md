Authoritative error and edge‑case specification for the Dayflow HRMS project
This document defines all possible error scenarios, when they can occur, how they must be handled, and how they must be presented to the user, strictly for a PHP + HTML + Bootstrap + JavaScript architecture.

This file exists to prevent:

Silent failures

Confusing behavior

Inconsistent error handling

AI‑generated “happy‑path‑only” logic

If an error scenario is not defined here, it must be treated as unsupported.

1. Purpose of This Document
The purpose of ERROR_SCENARIOS.md is to:

Enumerate all realistic failure and edge cases

Define expected system behavior for each case

Specify where errors are detected (PHP vs JS)

Enforce user‑friendly, non‑technical messaging

Ensure the system remains stable under incorrect usage

Errors are a first‑class concern, not an afterthought.

2. Error Handling Principles (Global Rules)
All errors in Dayflow must follow these rules:

Errors are detected server‑side (PHP) whenever possible

JavaScript may assist but is never authoritative

Errors must be:

Visible

Understandable

Recoverable

Errors must never:

Expose stack traces

Expose file paths

Expose PHP warnings/notices

Break page layout

3. Authentication Error Scenarios
3.1 Invalid Login Credentials
Scenario

User enters wrong email or password

Detected By

PHP (login handler)

System Behavior

Do not create session

Reload login.php

User Message

“Invalid email or password. Please try again.”

3.2 Missing Login Fields
Scenario

User submits login form with empty fields

Detected By

PHP (required field validation)

System Behavior

Reject submission

Highlight missing fields

User Message

“Please fill in all required fields.”

3.3 Access Without Authentication
Scenario

User directly accesses protected page URL

Detected By

PHP session check

System Behavior

Redirect to login.php

User Message

“Please log in to continue.”

4. Authorization (Role) Error Scenarios
4.1 Employee Accessing Admin Page
Scenario

Employee manually enters admin page URL

Detected By

PHP role check ($_SESSION['role'])

System Behavior

Destroy session (optional)

Redirect to login.php or employee dashboard

User Message

“You are not authorized to access this page.”

4.2 Missing or Invalid Role in Session
Scenario

Session exists but role is missing or corrupted

Detected By

PHP validation

System Behavior

Destroy session

Redirect to login

User Message

“Your session is invalid. Please log in again.”

5. Signup Error Scenarios
5.1 Missing Required Signup Fields
Scenario

User submits signup form with incomplete data

Detected By

PHP validation

System Behavior

Reject submission

Reload signup.php

User Message

“All fields are required to create an account.”

5.2 Invalid Role Selection
Scenario

Role value is missing or tampered with

Detected By

PHP validation

System Behavior

Reject signup

Do not create session

User Message

“Invalid role selected.”

6. Form Submission Error Scenarios (General)
6.1 Invalid POST Request
Scenario

Form accessed via GET instead of POST

CSRF‑like misuse (basic)

Detected By

PHP request method check

System Behavior

Ignore request

Redirect back to form page

User Message

“Invalid request. Please try again.”

6.2 Required Field Missing
Scenario

Any form submission missing required values

Detected By

PHP validation

System Behavior

Reject submission

Show inline errors

User Message

“Please complete all required fields.”

7. Profile Management Error Scenarios
7.1 Employee Editing Restricted Fields
Scenario

Employee manipulates HTML to edit salary/job fields

Detected By

PHP validation (ignore unauthorized fields)

System Behavior

Save only allowed fields

Ignore restricted changes

User Message

“Profile updated successfully.”

(No error shown; restricted fields remain unchanged)

7.2 Admin Editing Non‑Existent Employee
Scenario

Invalid employee ID in URL

Detected By

PHP lookup

System Behavior

Abort action

Redirect to employee list

User Message

“Employee record not found.”

8. Attendance Error Scenarios
8.1 Employee Modifying Other Employee Attendance
Scenario

Employee tampers with employee ID in request

Detected By

PHP ownership check

System Behavior

Reject update

Reload page

User Message

“You are not allowed to modify this record.”

8.2 Invalid Attendance State
Scenario

Attendance state not in allowed list

Detected By

PHP validation

System Behavior

Reject update

Keep previous state

User Message

“Invalid attendance status.”

9. Leave Management Error Scenarios
9.1 Employee Editing Approved/Rejected Leave
Scenario

Employee attempts to modify finalized leave

Detected By

PHP leave state check

System Behavior

Reject request

Reload leave page

User Message

“This leave request can no longer be modified.”

9.2 Admin Re‑approving Finalized Leave
Scenario

Admin attempts to change non‑pending leave

Detected By

PHP validation

System Behavior

Reject action

User Message

“This leave request is already finalized.”

10. Payroll Error Scenarios
10.1 Employee Attempting Payroll Edit
Scenario

Employee submits payroll edit form

Detected By

PHP role check

System Behavior

Reject request

Reload payroll page

User Message

“You do not have permission to edit payroll details.”

10.2 Invalid Payroll Data Input
Scenario

Admin submits invalid payroll values

Detected By

PHP validation

System Behavior

Reject update

Highlight fields

User Message

“Please enter valid payroll information.”

11. Session & State Error Scenarios
11.1 Expired Session
Scenario

Session times out or is destroyed

Detected By

PHP session check

System Behavior

Redirect to login

User Message

“Your session has expired. Please log in again.”

11.2 Corrupted Session Data
Scenario

Session variables missing or malformed

Detected By

PHP validation

System Behavior

Destroy session

Redirect to login

User Message

“An error occurred. Please log in again.”

12. JavaScript‑Related Error Scenarios
12.1 JavaScript Disabled
Scenario

User has JavaScript disabled

System Behavior

Core functionality still works

Minor UX enhancements missing

User Message

None required (graceful degradation)

12.2 JavaScript Failure
Scenario

JS error occurs during interaction

System Behavior

PHP still handles final submission

Page reload ensures consistency

13. Error Display Standards
All error messages must:

Be shown using Bootstrap alerts

Be placed near the relevant form or action

Be cleared after successful retry

Never stack infinitely

14. Forbidden Error Behaviors
The following are strictly forbidden:

White screen of death

Raw PHP error output

Console‑only errors

Silent failure with no feedback

Automatic retries without user intent

15. Relationship to Other Documents
This document must align with:

STATE_MODEL.md

APP_FLOW.md

USER_JOURNEYS.md

NON_FUNCTIONAL_REQUIREMENTS.md

CORE_SAFETY.md

If conflicts arise:

CORE_SAFETY.md has highest priority

16. Enforcement Rule
Any implementation that:

Ignores defined error scenarios

Fails silently

Exposes technical errors

Allows unauthorized actions without rejection

Is invalid and must be corrected.

