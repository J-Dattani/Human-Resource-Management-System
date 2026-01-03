Authoritative data model specification for the Dayflow HRMS project
This document defines all data entities, their fields, relationships, ownership rules, and validation expectations for the system, strictly aligned with a PHP + HTML + Bootstrap + JavaScript architecture.

This file exists to:

Prevent data inconsistency

Stop AI or developers from inventing fields

Clarify what data exists and what does not

Ensure role‑safe data access

If a data field or structure is not defined here, it must not be used.

1. Data Model Principles (Non‑Negotiable)
The following principles apply to all data in Dayflow:

All data is mocked or simulated

No real database is required

Data may be stored in:

PHP arrays

PHP session variables

Temporary in‑memory structures

PHP is the only authoritative data handler

JavaScript may display data but must never persist or decide it

2. Core Data Entities (Overview)
The system consists of the following core entities:

User

Employee Profile

Attendance Record

Leave Request

Payroll Record

No additional entities are allowed.

3. User Entity
3.1 Purpose
Represents an authenticated system user.

3.2 User Data Structure
$user = [
  'user_id' => 'string',
  'employee_id' => 'string',
  'email' => 'string',
  'role' => 'employee' | 'admin'
];
3.3 Storage Rules
Stored in PHP session after login/signup

Example:

$_SESSION['user'] = $user;
3.4 Validation Rules
user_id must exist

role must be either employee or admin

Email must be non‑empty (format validation optional)

4. Employee Profile Entity
4.1 Purpose
Stores personal and job‑related employee information.

4.2 Employee Profile Data Structure
$employee_profile = [
  'employee_id' => 'string',
  'name' => 'string',
  'email' => 'string',
  'phone' => 'string',
  'address' => 'string',
  'designation' => 'string',
  'department' => 'string',
  'profile_picture' => 'string',
  'salary' => 'number'
];
4.3 Ownership & Access Rules
Role	Access
Employee	Read all fields, edit limited fields
Admin	Read & edit all fields
Editable by Employee only:

phone

address

profile_picture

All other fields are read‑only for employees.

4.4 Validation Rules
employee_id must be unique (mock constraint)

Salary must be numeric

Restricted fields must be ignored if submitted by employee

5. Attendance Record Entity
5.1 Purpose
Tracks daily attendance status per employee.

5.2 Attendance Data Structure
$attendance_record = [
  'employee_id' => 'string',
  'date' => 'YYYY-MM-DD',
  'status' => 'present' | 'absent' | 'half_day' | 'leave'
];
5.3 Storage Rules
Stored as PHP array or session data

Indexed by employee and date

5.4 Access Rules
Role	Access
Employee	View & update own records
Admin	View & update all records
5.5 Validation Rules
Status must be one of the allowed values

Employee may update only their own records

Admin may update any record

6. Leave Request Entity
6.1 Purpose
Represents an employee leave application and its approval state.

6.2 Leave Data Structure
$leave_request = [
  'leave_id' => 'string',
  'employee_id' => 'string',
  'leave_type' => 'paid' | 'sick' | 'unpaid',
  'start_date' => 'YYYY-MM-DD',
  'end_date' => 'YYYY-MM-DD',
  'reason' => 'string',
  'status' => 'pending' | 'approved' | 'rejected',
  'admin_comment' => 'string'
];
6.3 Access Rules
Role	Access
Employee	Create & view own leave
Admin	View, approve, reject, comment
6.4 State Rules
Initial state: pending

Only Admin can change state

Once approved/rejected, state is immutable

6.5 Validation Rules
End date must not precede start date

Leave type must be valid

Employee cannot edit after submission

7. Payroll Record Entity
7.1 Purpose
Stores payroll information for display and admin editing.

7.2 Payroll Data Structure
$payroll = [
  'employee_id' => 'string',
  'basic_salary' => 'number',
  'allowances' => 'number',
  'deductions' => 'number',
  'net_display_salary' => 'number'
];
7.3 Access Rules
Role	Access
Employee	Read‑only
Admin	Read & edit
7.4 Important Constraints
No payroll calculations required

Values may be static or mock

net_display_salary may be manually set

8. Relationships Between Entities
User
  └── Employee Profile (1:1)
       ├── Attendance Records (1:N)
       ├── Leave Requests (1:N)
       └── Payroll Record (1:1)
Relationships are logical, not database‑enforced.

9. Data Validation Responsibilities
PHP:

Field validation

Role validation

Ownership validation

JavaScript:

UI‑level checks only (required fields, basic UX)

PHP validation always overrides JavaScript.

10. Data Persistence Rules
Data persists only for:

Session duration

Demo runtime

Logout must clear all session‑stored data

No long‑term persistence is expected or required

11. Forbidden Data Practices
The following are strictly forbidden:

Storing real employee data

Storing passwords in plain arrays

Letting JavaScript persist authoritative data

Adding undocumented fields

Inferring data structure from UI

12. Relationship to Other Documents
This data model must align with:

PROJECT_SPEC.md

PROJECT_SCOPE.md

STATE_MODEL.md

ERROR_SCENARIOS.md

CORE_SAFETY.md

If conflicts arise:

CORE_SAFETY.md has highest priority

13. Enforcement Rule
Any implementation that:

Introduces extra data fields

Modifies structures without documentation

Breaks access rules

Allows role‑unsafe data access

Is invalid and must be corrected.

