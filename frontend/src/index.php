<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dayflow HRMS</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F8FAFC;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .welcome-card {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            border: 1px solid #E5E7EB;
            text-align: center;
            max-width: 400px;
            width: 100%;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .btn-start {
            background-color: #1E293B;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            transition: background 0.2s;
        }

        .btn-start:hover {
            background-color: #0F172A;
            color: white;
        }
    </style>
</head>

<body>

    <div class="welcome-card">
        <h1 class="h3 fw-bold mb-3" style="color: #1E293B;">Dayflow</h1>
        <p class="text-muted mb-4">Human Resource Management System</p>

        <p class="small text-muted mb-4">
            Welcome to the Dayflow HRMS Demo.<br>
            Please login to access the portal.
        </p>

        <a href="auth/login.php" class="btn-start">Go to Login</a>
    </div>

</body>

</html>