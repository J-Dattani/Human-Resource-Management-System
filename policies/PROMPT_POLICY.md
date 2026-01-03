Authoritative policy governing how prompts are written, structured, and used for AI generation in the Dayflow HRMS project
This file exists to ensure AI prompts are precise, safe, reproducible, and aligned with project intent, so no confusion, hallucination, or scope drift occurs.

This document is binding for:

Anyone writing prompts for AI

Any AI-assisted development workflow

Any future contributor using AI tools on this project

1. Purpose of This Document
The purpose of PROMPT_POLICY.md is to:

Define how prompts must be written

Prevent vague, open-ended, or dangerous prompts

Ensure AI outputs are predictable and controlled

Guarantee AI respects project scope, roles, and flows

Eliminate ambiguity that could cause logic or design errors

This document ensures that AI behavior is shaped by intent, not creativity.

2. Prompt Philosophy (Core Principle)
All prompts in this project must follow this principle:

“AI is instructed, not inspired.”

Prompts must:

Be explicit

Be restrictive

Be contextual

Be document-backed

Creativity is not a goal.
Correctness, consistency, and safety are.

3. Mandatory Prompt Structure
Every AI prompt used in this project must include all of the following sections, explicitly or implicitly.

3.1 Context Declaration
The prompt must clearly state:

Project name: Dayflow – Human Resource Management System

Nature: Frontend-first HRMS prototype

Intended usage: Demo / hackathon / academic showcase

Example (required pattern):

“You are working on an existing frontend-only HRMS prototype called Dayflow…”

3.2 Scope Declaration
The prompt must clearly define:

What the AI is allowed to do

What the AI must not do

Prompts must explicitly state:

“Frontend-only”

“No backend logic”

“No new features outside scope”

3.3 Role & Permission Awareness
The prompt must mention:

The existence of Employee and Admin/HR roles

That role-based access is mandatory

That permissions must not be altered

AI must be reminded that:

Employees cannot see or edit admin data

Admins have elevated but controlled privileges

3.4 Non‑Negotiable Constraints
Every prompt must include constraints such as:

Do NOT add new roles

Do NOT add backend APIs

Do NOT invent business rules

Do NOT change existing flows

Do NOT redesign UI unless explicitly requested

Prompts without constraints are invalid.

4. Required Prompt Content Rules
4.1 Prompts MUST:
Reference at least one project document (by name)

Define the exact task to be performed

State what must remain unchanged

Define success criteria clearly

Specify if the task is:

New implementation

Refactor

Bug fix

UI-only change

4.2 Prompts MUST NOT:
Use vague language like:

“Make it better”

“Improve UX”

“Build a full system”

Ask AI to:

“Decide the best approach”

“Add missing features”

“Optimize business logic”

Decision-making is human responsibility.

5. Prompt Scope Enforcement
5.1 Allowed Prompt Types
AI prompts may be used for:

Creating a specific component

Implementing a defined flow

Generating mock data

Fixing a clearly described issue

Refactoring without behavior change

5.2 Forbidden Prompt Types
AI prompts must never ask for:

Full system redesign

End-to-end backend creation

Payroll calculations

Legal or compliance logic

Performance optimizations beyond UI

6. Prompt Granularity Rules
Prompts must be:

Small and focused

One responsibility per prompt

Forbidden:

“Build the entire dashboard”

“Implement complete HR system”

Required instead:

“Implement the Leave Approval table UI for Admin role…”

7. Prompt Determinism Requirement
Prompts must aim to produce:

Deterministic outputs

Minimal variation between runs

Predictable structure

To achieve this:

Avoid optional language

Avoid “if needed” clauses

Avoid open-ended goals

8. Prompt Versioning & Traceability
Every major prompt should be:

Saved

Versioned

Traceable to:

A task

A file

A document requirement

If code is questioned later:

“Which prompt generated this?”
must have a clear answer.

9. Error Handling in Prompts
Prompts must instruct AI to:

Handle errors gracefully

Prefer safe failure over guessing

Ask for clarification instead of assuming

AI must never silently invent behavior to “fix” missing details.

10. Conflict Resolution Rule (Prompt Level)
If a prompt conflicts with:

CORE_SAFETY.md

AI_GOVERNANCE.md

Any project specification

Then:

The prompt is invalid

AI must refuse or limit output

The prompt must be rewritten

11. Prompt Review Requirement
Before using a prompt:

It must be reviewed by a human

It must be checked against:

Project scope

Role rules

Safety constraints

Unreviewed prompts must not be used for critical code.

12. Enforcement Rule
Any code, logic, or UI generated from:

A vague prompt

An unrestricted prompt

A scope-violating prompt

Is considered non-compliant and must be rewritten.

This file has equal authority to CORE_SAFETY.md and AI_GOVERNANCE.md.




