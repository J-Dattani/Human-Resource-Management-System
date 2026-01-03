Authoritative human‑in‑the‑loop governance document for the Dayflow HRMS project
This file defines where, how, and why human review is mandatory, especially when AI is involved.
Its purpose is to ensure no autonomous decisions, silent changes, or unverified logic enter the system.

This document is binding for:

Developers

Reviewers

Anyone using AI to generate code, logic, or documentation

1. Purpose of Human Oversight
The purpose of HUMAN_OVERSIGHT.md is to:

Ensure humans remain the final authority

Prevent AI‑generated logic from being blindly trusted

Catch scope drift, permission leaks, and unsafe assumptions

Guarantee accountability for all changes

Preserve intent defined in project documentation

AI may assist, but humans are responsible.

2. Core Principle
The core principle of this project is:

No AI-generated output is considered valid until a human explicitly reviews and accepts it.

There are no exceptions to this rule.

3. Areas Requiring Mandatory Human Review
Human review is mandatory in the following areas:

3.1 Role-Based Logic
Employee vs Admin permissions

Route guards

Conditional rendering

Edit vs read-only access

Any mistake here is considered critical.

3.2 Approval & Workflow Logic
Leave approval

Attendance modification

Payroll edits

Admin-only actions

Humans must verify:

Correct role enforcement

Correct state transitions

No auto-approval or silent state changes

3.3 Data Handling & State Management
Mock data structures

State persistence logic

Local/session storage usage

Reset or logout behavior

Humans must ensure:

No cross-user data leakage

No unintended persistence

3.4 Error Handling & Edge Cases
Invalid input handling

Unauthorized access attempts

Empty or missing data states

AI often underestimates edge cases — human validation is required.

3.5 UI & UX Decisions
Button labeling

Confirmation dialogs

Visibility of sensitive actions

Clarity of user intent

Humans must confirm the UI is:

Understandable

Non-deceptive

Aligned with HR workflows

4. Human Review Responsibilities
4.1 Developer Responsibilities
Developers must:

Review AI-generated code line by line

Ensure behavior matches documentation

Reject AI output that introduces assumptions

Verify no scope violations occur

4.2 Reviewer Responsibilities
Reviewers must:

Cross-check against governance files

Validate role safety

Confirm flows match APP_FLOW.md

Confirm permissions match AUTHORIZATION_MODEL.md

5. AI Output Acceptance Criteria
AI-generated output may be accepted only if all conditions below are met:

Aligns with CORE_SAFETY.md

Complies with AI_GOVERNANCE.md

Follows PROMPT_POLICY.md

Does not add new features

Does not change existing logic unintentionally

Is readable and maintainable

If any condition fails → output must be rejected or revised.

6. Prohibited Autonomous Behavior
The following are explicitly forbidden:

Auto-merging AI-generated code

Deploying AI-generated changes without review

Letting AI decide business rules

Letting AI resolve ambiguities without human input

This project does not allow autonomous AI behavior.

7. Review Checkpoints (When to Pause)
Humans must pause and review at these checkpoints:

After any AI-generated feature

After modifying role-based logic

After touching approval workflows

Before demos, submissions, or deployments

Skipping a checkpoint is considered a process failure.

8. Handling Disagreements with AI Output
If AI output:

Conflicts with documentation

Seems overly complex

Introduces unnecessary abstractions

Adds “best practices” not requested

Then:

The AI output must be questioned

The simpler, documented approach must be preferred

Documentation always wins

9. Accountability & Traceability
For every major change:

A human owner must be identifiable

A reason for the change must exist

A document reference must justify it

“No one knows why this exists” is unacceptable.

10. Failure & Recovery Policy
If a human later discovers:

A permission leak

A workflow violation

A misleading UI behavior

Then:

The change must be reverted

The cause must be identified

The prompt or process must be fixed

Documentation may be updated if needed

11. Relationship to Other Governance Files
This document works together with:

CORE_SAFETY.md → defines hard safety limits

AI_GOVERNANCE.md → defines AI boundaries

PROMPT_POLICY.md → defines how AI is instructed

If conflicts arise:

CORE_SAFETY.md has highest priority

12. Enforcement Rule
Any contribution that bypasses human oversight is:

Non-compliant

Invalid

Subject to immediate rollback

Human oversight is not optional in this project.

