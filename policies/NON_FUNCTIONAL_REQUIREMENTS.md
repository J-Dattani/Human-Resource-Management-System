Authoritative non‑functional requirements for the Dayflow HRMS project
This document defines how the system must behave, not what features it provides.
These requirements apply across all modules, pages, roles, and flows and are mandatory for both human and AI contributors.

This file exists to ensure the system is:

Usable

Reliable

Predictable

Demo‑ready

Free from hidden technical debt

1. Purpose of This Document
The purpose of NON_FUNCTIONAL_REQUIREMENTS.md is to:

Define quality attributes of the system

Prevent usability, performance, and stability issues

Set expectations beyond functional features

Provide AI with clear constraints on how to implement features

If a feature works functionally but violates these requirements, it is considered incorrect.

2. Usability Requirements
2.1 Clarity & Learnability
The system must be usable without training

First‑time users should understand:

Where they are

What actions they can take

What role they are operating under

All labels must be:

Clear

Human‑readable

Non‑technical

2.2 Role Awareness
The UI must clearly reflect the user’s role

Admin‑only actions must never appear for employees

Employees must never be confused into thinking they can approve or edit admin data

Role clarity is mandatory on every screen.

3. Responsiveness Requirements
3.1 Device Support
The application must function correctly on:

Very small phones (≈200–320px width)

Small phones (360–400px)

Tablets (≥768px)

Laptops (≥1024px)

Large screens

3.2 Layout Behavior
No horizontal scrolling on any page

No overlapping UI elements

Tables must:

Scroll vertically if needed

Stack or wrap gracefully on small screens

Forms must:

Reflow vertically

Never overflow screen width

Responsiveness fixes must not alter design intent.

4. Performance Requirements
4.1 Load Performance
Initial page load must feel fast

UI must render immediately with no long blocking states

Mock data must be lightweight

This is a demo system — perceived speed matters.

4.2 Interaction Performance
Button clicks must respond instantly

Navigation must not feel laggy

State changes (approval, edits) must reflect immediately in UI

No spinners or loaders unless absolutely necessary.

5. Reliability & Stability Requirements
5.1 Predictable Behavior
Same action must always produce the same result

No random or inconsistent state changes

No hidden background behavior

5.2 State Safety
User session must be isolated

Logging out must reset all user‑specific data

Refreshing the page must not corrupt state

State behavior must be explainable and traceable.

6. Error Handling Requirements
6.1 Error Visibility
Errors must always be visible to the user

No silent failures

No console‑only errors

6.2 Error Messaging
Errors must be:

Clear

Non‑technical

Actionable where possible

Example:

“Please fill all required fields”

Not: “Undefined property of null”

7. Accessibility Requirements (Baseline)
The system must follow basic accessibility principles:

Click targets must be reasonably sized

Text must be readable

Color must not be the only indicator of status

Forms must be keyboard‑usable

Advanced accessibility compliance is not required, but basic inclusivity is mandatory.

8. Consistency Requirements
8.1 UI Consistency
Same actions must look and behave the same across pages

Buttons, tables, and forms must follow consistent patterns

Status indicators must be consistent across modules

8.2 Behavioral Consistency
Approval logic behaves the same everywhere

Edit vs read‑only rules never change unexpectedly

Navigation behaves consistently across roles

9. Maintainability Requirements
9.1 Code Readability
Code must be readable by another developer

No overly clever or cryptic logic

Clear naming for:

Components

State

Actions

9.2 Simplicity Preference
Prefer simple logic over abstraction

Avoid premature optimization

Avoid unnecessary architectural layers

10. Demo & Evaluation Readiness
The system must be suitable for:

Live demo

Screen recording

Evaluation by judges or reviewers

This means:

No broken screens

No placeholder text visible to users

No “TODO” labels in UI

11. AI‑Specific Non‑Functional Constraints
AI‑generated code must:

Respect all requirements in this document

Not trade usability for speed of generation

Avoid overengineering

Avoid adding unnecessary libraries or patterns

If AI output violates these constraints, it must be rewritten.

12. Relationship to Other Documents
This document must align with:

PROJECT_SCOPE.md

PROJECT_SPEC.md

APP_FLOW.md

CORE_SAFETY.md

If conflicts arise:

CORE_SAFETY.md takes highest priority

13. Enforcement Rule
Any implementation that:

Technically works but

Violates usability, performance, or stability requirements

Is considered non‑compliant and must be corrected.

Non‑functional quality is not optional in this project.