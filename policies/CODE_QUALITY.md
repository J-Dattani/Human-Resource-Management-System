Authoritative code quality rules for the Dayflow HRMS project
This document defines what “good code” means for this project, how quality is evaluated, and which practices are mandatory vs forbidden, especially in a hackathon + demo‑ready context.

This file exists to:

Keep the codebase clean under time pressure

Prevent fragile or rushed implementations

Ensure AI‑generated and human‑written code are equally readable

Avoid “it works but breaks later” situations

If code violates this document, it is considered low quality, even if it functions.

1. Definition of Code Quality (For This Project)
In Dayflow, high‑quality code means code that is:

Easy to read

Easy to explain

Easy to debug

Easy to modify during a demo

Predictable under edge cases

⚠️ Code quality is not about:

Advanced patterns

Performance optimizations

Enterprise‑level abstractions

2. Quality Goals (Priority Order)
All code must optimize for the following, in order:

Correctness

Clarity

Consistency

Simplicity

Demo stability

Anything that harms a higher‑priority goal is forbidden.

3. Readability Standards (Mandatory)
3.1 Readability Rules
Code must be readable without comments

Variable names must explain intent

Logic must be linear and obvious

✅ Good:

$is_admin = ($_SESSION['role'] === 'admin');
❌ Bad:

$a = $_SESSION['r'] == 'a';
3.2 Function & File Length
PHP files should remain:

Short

Focused

Single‑purpose

If a file feels “busy”, it’s low quality

4. Consistency Rules
4.1 Consistency Across Files
Same patterns must be used everywhere:

Session checks

Form handling

Error handling

No one‑off logic allowed

If something is done once, it must be done the same way everywhere.

4.2 Naming Consistency
Same concept → same name

No synonyms for the same thing

Example:

Always use employee_id

Never mix with empId, eid, etc.

5. Simplicity Rules (Critical)
5.1 Avoid Overengineering
The following reduce code quality and are forbidden:

Helper classes for simple logic

Generic “utility” abstractions

Framework‑like patterns

Deep include chains

If logic fits in the page cleanly, keep it there.

5.2 Linear Control Flow
Preferred:

validate();
if (error) {
  show_error();
  return;
}
process();
render();
Forbidden:

Nested condition pyramids

Hidden early exits

Implicit behavior

6. Error Handling Quality
6.1 Error Handling Rules
High‑quality error handling:

Is explicit

Is predictable

Always informs the user

Low‑quality error handling:

Silent failure

Console‑only messages

PHP warnings shown to user

All errors must follow ERROR_SCENARIOS.md.

7. Input Validation Quality
7.1 Validation Rules
Every input must be validated in PHP

Validation logic must be:

Easy to read

Close to where data is handled

❌ Forbidden:

if ($x) { /* trust it */ }
✅ Required:

if (empty($_POST['leave_type'])) {
  $error = 'Leave type is required';
}
8. JavaScript Code Quality
8.1 JS Quality Definition
High‑quality JS:

Is small

Is optional

Improves UX only

Low‑quality JS:

Controls business logic

Replaces PHP checks

Breaks page without fallback

8.2 JS Simplicity Rule
If something can be done in HTML + PHP cleanly:
👉 Do not use JavaScript

9. HTML & UI Code Quality
9.1 UI Quality Rules
UI must not hide logic

UI must reflect backend truth

UI errors must match PHP errors

Good UI:

Shows clear states

Handles empty data

Never lies to the user

10. Duplication Rules
10.1 Acceptable Duplication
Because this is a hackathon project:

Small duplication is acceptable

Readability > DRY

❌ Over‑abstracting to remove duplication is worse than duplication itself.

11. AI‑Generated Code Quality Rules
Any AI‑generated code must:

Match existing style exactly

Follow CODING_STANDARDS.md

Avoid introducing new patterns

Be explainable line‑by‑line

If you cannot explain AI‑generated code:
👉 It is low quality and must be rewritten

12. Review Checklist (Self‑Review)
Before accepting any code, ask:

Can I explain this in 30 seconds?

Is the flow obvious?

Are responsibilities respected?

Would this survive a live demo?

Does this match existing patterns?

If any answer is “no”, quality is insufficient.

13. Forbidden Low‑Quality Practices (Critical)
The following immediately fail quality review:

Magic values with no explanation

Commented‑out code

Debug statements in final code

Logic hidden in includes

JavaScript deciding authority

Inconsistent patterns across files

14. Relationship to Other Documents
This document must align with:

CODING_STANDARDS.md

ARCHITECTURE.md

FRONTEND_ARCHITECTURE.md

COMPONENT_RESPONSIBILITIES.md

ERROR_SCENARIOS.md

CORE_SAFETY.md

If conflicts arise:

CORE_SAFETY.md has highest priority

15. Enforcement Rule
Any code that:

Reduces clarity

Introduces unnecessary complexity

Breaks consistency

Cannot be confidently demoed

Is low quality and must be corrected.