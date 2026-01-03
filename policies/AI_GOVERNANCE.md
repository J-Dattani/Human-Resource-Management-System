Authoritative AI governance and AI‑usage control document
This document defines how AI is allowed to be used, what AI can and cannot generate, and how AI output must be reviewed and integrated.

This file merges:

AI_CODE_WORKFLOW.md

AI_USAGE_GUIDE.md

AI governance rules

1. Purpose of AI Governance
AI is used in this project to:

Accelerate development

Reduce boilerplate work

Improve consistency

AI must never:

Replace human judgment

Invent system behavior

Override documented rules

2. Approved AI Use Cases
AI is allowed to:

Generate PHP pages following documentation

Generate HTML/Bootstrap UI

Generate validation logic

Generate documentation files

Refactor code for clarity

All AI output must follow:

CORE_SAFETY.md

CODING_STANDARDS.md

Project scope

3. Forbidden AI Use Cases
AI must never:

Introduce new features without approval

Invent APIs, frameworks, or databases

Change architecture assumptions

Modify scope silently

Generate production‑grade security claims

4. AI Code Generation Rules
All AI‑generated code must:

Be readable by a beginner

Use existing patterns only

Avoid abstraction layers

Remain page‑based (PHP)

If AI output introduces:

SPA logic

Framework assumptions

Hidden state

→ It must be rejected.

5. AI Review & Human Oversight
Every AI output must be:

Read by a human

Checked against docs

Validated for scope safety

Human approval is mandatory before:

Committing code

Demo usage

Feature expansion

6. Prompt Governance
Prompts must:

Be explicit

Reference correct files

Avoid vague language

Bad prompt:

“Make it better”

Good prompt:

“Improve validation in leave.php without changing flow or scope”

7. Change Control with AI
AI must not:

Auto‑apply changes across files

Refactor without permission

Merge concerns across layers

Each AI task must:

Target one file or concern

Respect responsibility boundaries

8. AI Error Handling
If AI generates:

Incorrect logic

Unsafe patterns

Conflicting rules

The output must be:

Discarded

Re‑prompted correctly

Never “patched blindly”

9. Accountability Rule
AI is a tool, not an authority.

Final responsibility always lies with:

The developer

The team

Human reviewers

10. Enforcement Rule
If AI output conflicts with:

CORE_SAFETY.md

PROJECT_SCOPE.md

The documentation overrides AI output