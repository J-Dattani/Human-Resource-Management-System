Authoritative scope definition for the Dayflow HRMS project
This document defines exactly what is in scope and what is out of scope for this project.
It exists to prevent scope creep, overengineering, and AI hallucination, and it must be enforced strictly.

This file is binding for:

Developers

Reviewers

AI-assisted code generation

1. Purpose of This Document
The purpose of PROJECT_SCOPE.md is to:

Clearly define the functional boundaries of the project

Eliminate ambiguity about what must be built

Prevent unnecessary or misleading features

Act as a guardrail for AI and human contributors

Ensure the project remains achievable, clean, and demo‑ready

If a feature is not explicitly listed as “In Scope”, it must be treated as Out of Scope.

2. Overall Scope Statement
Dayflow is a frontend-first HRMS prototype that demonstrates:

Employee self‑service workflows

HR/Admin approval workflows

Role‑based access control

Core HR operations visibility

The system is designed for demonstration and evaluation, not real organizational deployment.

3. IN‑SCOPE FEATURES (MANDATORY)
The following features must be implemented for the project to be considered complete.

3.1 Authentication (Frontend‑Only)
Sign Up:

Employee ID

Email

Password

Role selection (Employee / Admin)

Sign In:

Email + Password

Logout:

Clears session data

✔ Authentication is simulated
✔ No real backend authentication

3.2 Role‑Based Access Control
Two roles only:

Employee

Admin / HR

Role determines:

Visible pages

Allowed actions

Editable vs read‑only fields

Role enforcement must be applied:

In UI rendering

In routing

In state logic

3.3 Dashboard Module
Post‑login landing page

Role‑specific content:

Employee dashboard → self‑service navigation

Admin dashboard → management overview

Navigation to all allowed modules

No analytics dashboards are required.

3.4 Employee Profile Management
Employee

View full profile

Edit only:

Address

Phone number

Profile picture

Admin

View all employee profiles

Edit all profile fields

Profile data may be mocked but must behave consistently.

3.5 Attendance Management
Attendance states:

Present

Absent

Half‑day

Leave

Employee:

View own attendance

Mark attendance (check‑in / check‑out)

Admin:

View attendance of all employees

Modify attendance records

No biometric or location tracking.

3.6 Leave Management & Approval
Leave types:

Paid

Sick

Unpaid

Leave lifecycle:

Applied → Pending → Approved / Rejected
Employee:

Apply for leave

View status

Admin:

Approve / Reject leave

Add comments

Leave status must reflect correctly across modules.

3.7 Payroll Visibility & Management
Employee:

View payroll (read‑only)

Admin:

View and edit payroll structure (mocked)

✔ Payroll is display‑only
✔ No calculations or payments

3.8 Navigation & State Persistence
Role‑aware navigation

No access to unauthorized routes

Optional page persistence on refresh

Clean state reset on logout

4. OUT‑OF‑SCOPE FEATURES (STRICT)
The following features must NOT be implemented, even partially.

4.1 Backend & Infrastructure
Backend servers

Databases

REST or GraphQL APIs

Authentication services

Cloud infrastructure

4.2 Payroll & Finance
Salary calculations

Tax computation

Payslip generation

Salary disbursement

Bank integrations

4.3 Compliance & Legal
Labor law enforcement

Government reporting

Statutory compliance logic

Audit trails for legal use

4.4 Communication & Notifications
Email notifications

SMS or WhatsApp alerts

Push notifications

Real messaging systems

4.5 Advanced & Enterprise Features
Multi‑organization support

Department hierarchies

Role customization

AI analytics or predictions

Attendance via biometrics or GPS

5. UI & UX Scope Constraints
Clean, minimal UI

Table and form‑based layouts

Responsive across devices

No advanced data visualizations required

Visual polish is allowed, but functional correctness is the priority.

6. AI Scope Enforcement Rules
AI tools must:

Generate only features listed as in‑scope

Refuse to generate out‑of‑scope features

Ask for clarification instead of assuming

Any AI output violating this scope is invalid.

7. Handling Scope Change Requests
If a new feature is requested:

It must be evaluated against this document

It must be explicitly approved

This file must be updated first

No “small additions” are allowed without documentation.

8. Definition of “Scope Complete”
The project is considered scope‑complete when:

All in‑scope features exist

All out‑of‑scope features are excluded

No placeholder enterprise logic exists

The system can be demonstrated end‑to‑end

9. Relationship to Other Documents
This document works with:

PROJECT_SPEC.md → what to build

PRODUCT_VISION.md → why to build

CORE_SAFETY.md → what must never be violated

If conflicts arise:

CORE_SAFETY.md takes highest priority

10. Enforcement Rule
Any code, UI, or AI‑generated output that:

Exceeds this scope

Blurs in‑scope vs out‑of‑scope boundaries

Introduces misleading features

Must be rejected or removed immediately.