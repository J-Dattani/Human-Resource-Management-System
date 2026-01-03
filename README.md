# Dayflow – Human Resource Management System
**"Every workday, perfectly aligned."**

### 📘 Project Overview
Dayflow is a web‑based Human Resource Management System (HRMS) designed to digitize and streamline core HR operations into a simple, role‑based dashboard. The system focuses on clarity, usability, and role safety, built as a frontend‑first PHP page‑based application.

**Key Objectives:**
- Centralize employee records, attendance, and leave management.
- Provide clear, role‑based access control (Admin vs. Employee).
- Ensure transparent workflows without unnecessary complexity.
- Demonstrate a clean, consistent, and demo‑ready architecture.

---

### 🚀 Key Features

#### 👤 User Authentication & Roles
- **Secure Sign Up / Sign In**: Mocked authentication using Employee ID/Email.
- **Role Enforcement**: Strict separation between:
    - **Employee**: Limited access (Self-service).
    - **Admin / HR Officer**: Full management privileges.

#### 📊 Role-Based Dashboards
- **Employee Dashboard**: Quick access to Profile, Attendance, Leave, and Payroll.
- **Admin Dashboard**: Centralized view of all employees, attendance logs, and approval queues.

#### 📝 Core Modules
1.  **Profile Management**:
    - Employees can view details and edit limited fields (Address, Phone).
    - Admins can manage all employee records and job details.

2.  **Attendance Tracking**:
    - Daily/Weekly views.
    - Status tracking: *Present, Absent, Half-day, Leave*.
    - Employees mark their own attendance; Admins oversee all.

3.  **Leave Management**:
    - **Apply**: Employees request Paid, Sick, or Unpaid leave with date ranges.
    - **Approval Workflow**: Admins accept or reject requests with comments.
    - **Status**: Updates reflect immediately (*Pending → Approved/Rejected*).

4.  **Payroll Visibility**:
    - **Employee View**: Read-only access to salary structure and pay slips.
    - **Admin Control**: Manage salary components and ensure accuracy.

---

### 🛠️ Technology Stack
This project follows a **"Keep It Simple"** architecture:
-   **Frontend**: HTML5, CSS3, Bootstrap 5 (Responsive Layouts).
-   **Interactivity**: Vanilla JavaScript (UI enhancements & Validation only).
-   **Backend Logic**: PHP (Page-based routing & Control logic).
-   **State Management**: PHP Sessions (Single source of truth).
-   **Data Storage**: Mock Data / In-memory structures (Demo-safe, no database required).

---

### 🛡️ Safety & Security Principles
Dayflow enforces strict governance rules to ensure safety and demo reliability:
1.  **Server Authority**: PHP sessions are the only trusted source for Auth/Role state.
2.  **No Real Data**: The system explicitly forbids the storage of real personal or financial data.
3.  **Role Isolation**: Employees can never access Admin routes; Direct URL access is validated.
4.  **JS Constraints**: JavaScript is used *only* for UI; it never handles security or authorization.

---

### 📂 Project Structure
The repository is organized to maintain clear separation of concerns:

```
/my-hackathon-app
├── policies/
│   ├── CORE_SAFETY.md           # Non-negotiable safety rules
│   ├── PRODUCT_VISION.md        # Product goals and boundaries
│   ├── PROJECT_SCOPE.md         # In-scope vs Out-of-scope features
│   ├── APP_FLOW.md              # Application logic flow
│   ├── USER_JOURNEYS.md         # Step-by-step user paths
│   ├── ARCHITECTURE.md          # Technical architecture
│   ├── CODING_STANDARDS.md      # Code style and patterns
│   └── README.md                # This file
├── src/                         # Application Source Code
│   ├── index.php
│   ├── login.php
│   ├── dashboard.php
│   └── ...
└── assets/                      # Static resources (CSS, JS, Images)
```

---

### 🧭 Application Flow
1.  **Login/Signup**: User enters credentials.
2.  **Role Resolution**: System identifies `Employee` or `Admin` role.
3.  **Redirect**: User lands on the appropriate Dashboard.
4.  **Action**: User navigates to a module (e.g., Leave).
5.  **Processing**: PHP validates Session > Role > Input > Updates Mock Data.
6.  **Feedback**: Page reloads with Success/Error message.

---

### 🔮 Future Enhancements
-   Advanced Analytics & Reports (Salary slips, Attendance trends).
-   Email & Notification Alerts.
-   Calendar View for Team Leave/Attendance.

---

