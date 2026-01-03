Single source of truth for safety, security, and system protection rules
This document defines all mandatory safety, security, and misuse‑prevention rules for the Dayflow HRMS project.

This file exists to ensure:

No unsafe behavior is introduced

No privilege escalation occurs

No sensitive logic leaks to the client

AI‑generated or human code remains safe by default

If a rule is not explicitly allowed here, it is implicitly forbidden.

1. Purpose & Scope
CORE_SAFETY.md governs:

Application safety boundaries

Security rules (merged from SECURITY.md)

Authorization safety constraints

Data misuse prevention

Safe‑by‑default coding expectations

This applies to:

All PHP files

All JavaScript

All AI‑generated code

All contributors

2. Fundamental Safety Principles (Non‑Negotiable)
The system must always follow:

Server is authoritative

Client is untrusted

Role ≠ UI

State ≠ JavaScript

Explicit checks over assumptions

Any violation is a critical safety defect.

3. Authentication Safety Rules
Authentication must be handled only in PHP

Session ($_SESSION) is the only valid auth source

Every protected page must:

Check session existence

Reject unauthenticated access

Forbidden:

Client‑side auth checks

Cookie‑only auth

UI‑based auth assumptions

4. Authorization & Role Safety
Role must be stored in session ($_SESSION['role'])

Role must be validated on every request

UI visibility ≠ permission

Rules:

Employees must never access admin pages

Admin pages must hard‑fail if role is invalid

Role tampering must result in logout

5. Input & Action Safety
All inputs must be treated as hostile:

Validate every $_POST and $_GET

Ignore unauthorized fields silently

Reject invalid state transitions

Forbidden:

Trusting hidden inputs

Trusting disabled fields

Trusting JavaScript validation alone

6. Data Safety (Merged Security Rules)
No real personal or financial data allowed

All data is mock or demo‑safe

No passwords stored in plain arrays

No sensitive data logged or echoed

Allowed:

Demo emails

Fake employee IDs

Mock payroll numbers

7. Session Safety
Session must be started explicitly

Logout must:

Destroy session

Clear all state

Session corruption must force re‑login

Forbidden:

Long‑lived sessions

Partial session clears

Client‑side session reconstruction

8. JavaScript Safety Constraints
JavaScript must never:

Decide authentication

Decide authorization

Persist authoritative data

Perform privileged actions

JavaScript may:

Validate forms

Improve UX

Display feedback

9. Error Safety
Errors must never expose:

File paths

Stack traces

PHP warnings

All errors must be:

User‑friendly

Non‑technical

Recoverable

Error behavior must align with ERROR_SCENARIOS.md.

10. AI‑Generated Code Safety
Any AI‑generated code must:

Follow this document strictly

Avoid introducing new attack surfaces

Avoid assumptions about frameworks or APIs

Be explainable line‑by‑line

Unsafe AI output must be discarded, not patched.

11. Forbidden High‑Risk Behaviors (Critical)
The following are strictly forbidden:

Client‑side authorization

Hidden privilege checks

Silent failures

Hardcoded bypasses

Undocumented backdoors

12. Enforcement Rule (Highest Priority)
If any document conflicts with this file:

CORE_SAFETY.md overrides everything