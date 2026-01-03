Authoritative system specification for the Dayflow HRMS project
This document defines exactly what the system is, what modules exist, how roles interact, and what must be implemented.
It acts as the technical and functional contract for humans and AI.

This file must be read before any development or AI code generation.

1. Project Identification
1.1 Project Name
Dayflow – Human Resource Management System

1.2 Project Type
Frontend‑first web application

HRMS (Human Resource Management System)

Demo / hackathon / academic showcase project

1.3 Intended Audience
Hackathon judges

Academic evaluators

Developers reviewing system design

AI tools used for assisted development

2. System Overview
Dayflow is a role‑based HR management system that provides:

Employee self‑service functionality

Administrative HR controls

Clear approval workflows

Visibility into HR‑related data

The system is designed to demonstrate HR processes, not to act as a production enterprise HR platform.

3. Supported User Roles (Hard Constraint)
The system supports exactly two roles.

3.1 Employee
A standard organizational employee.

3.2 Admin / HR Officer
A user responsible for HR operations and approvals.

⚠️ No other roles are allowed.
Any implementation introducing additional roles is invalid.

4. Authentication Specification
4.1 Authentication Model
Frontend‑only authentication

Mocked or simulated login/signup

No real backend authentication server

4.2 Sign Up Requirements
A user must provide:

Employee ID

Email address

Password

Role selection (Employee or Admin)

4.3 Sign In Requirements
Email

Password

4.4 Session Handling
Session persistence via browser storage

Logout must clear all session data

5. Application Modules (Core Specification)
The system is composed of the following mandatory modules.

5.1 Dashboard Module
Purpose
Acts as the primary navigation hub after login.

Employee Dashboard
Displays navigation cards/links to:

Profile

Attendance

Leave

Payroll

Logout

Shows only employee‑relevant information

Admin Dashboard
Displays:

Employee overview

Pending leave requests

Attendance overview

Provides access to all management modules

Role‑based rendering is mandatory.

5.2 Employee Profile Module
Purpose
Manages employee personal and job information.

Employee Capabilities
Employees may:

View their full profile

Edit only:

Address

Phone number

Profile picture

Employees may not edit job or payroll fields.

Admin Capabilities
Admins may:

View all employee profiles

Edit all profile fields, including job and salary details

5.3 Attendance Module
Purpose
Tracks employee presence and work status.

Attendance States
Present

Absent

Half‑day

Leave

Employee Capabilities
View own attendance records

Mark attendance (check‑in / check‑out)

Admin Capabilities
View attendance for all employees

Modify attendance records when required

Attendance data may be mocked but must behave consistently in UI.

5.4 Leave Management Module
Purpose
Handles leave application and approval workflows.

Leave Types
Paid Leave

Sick Leave

Unpaid Leave

Leave Lifecycle
Applied → Pending → Approved / Rejected
Employee Capabilities
Apply for leave

View leave status

View admin comments (if any)

Admin Capabilities
View all leave requests

Approve or reject leave

Add approval/rejection comments

Employees cannot modify leave requests once approved or rejected.

5.5 Payroll Module
Purpose
Provides payroll visibility and management.

Employee View
Read‑only payroll information

Salary breakdown display

No edit capability

Admin View
View payroll details for all employees

Edit payroll structure fields (mocked)

⚠️ No payroll calculation or payment processing is required.

6. Navigation & Routing Rules
All navigation must be role‑aware

Unauthorized routes must not be accessible

Navigation state may persist across refresh

No dead or inaccessible routes are allowed

7. Data Handling Rules
All data is mock or simulated

Data exists only for demo purposes

No real persistence beyond local/session storage

Data must reset cleanly on logout

8. Error Handling Requirements
The system must handle:

Invalid login credentials

Unauthorized access attempts

Empty or missing data states

Invalid form inputs

Errors must be:

User‑friendly

Clearly communicated

Non‑technical

9. Non‑Goals (Explicit Exclusions)
The following are explicitly not part of this project:

Real payroll computation

Salary disbursement

Government compliance

Email or SMS notifications

Backend services or APIs

Multi‑organization support

10. Definition of “Correct Implementation”
An implementation is considered correct if:

All listed modules exist

Role‑based permissions are enforced everywhere

No unauthorized access paths exist

All flows work end‑to‑end

UI behavior matches defined responsibilities

Visual polish is secondary to functional correctness.

11. Relationship to Other Documents
This specification must align with:

PRODUCT_VISION.md

PROJECT_SCOPE.md

APP_FLOW.md

USER_JOURNEYS.md

CORE_SAFETY.md

If any conflict arises, CORE_SAFETY.md takes precedence.

12. Enforcement Rule
Any feature, behavior, or AI‑generated output that:

Violates this specification

Adds undocumented functionality

Changes role behavior

Is considered out of scope and invalid.