<!DOCTYPE html>
<html>
<head>
    <title>HRMS Login</title>
</head>
<body>

<h2>Login</h2>

<form id="loginForm">
    Email:<br>
    <input type="email" name="email" required><br><br>

    Password:<br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<p id="msg"></p>

<script>
document.getElementById("loginForm").addEventListener("submit", function(e){
    e.preventDefault();

    let formData = new FormData(this);

    fetch("auth/login.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(res => {
        if(res === "Admin") {
            location.href = "admin/dashboard.php";
        } 
        else if(res === "Employee") {
            location.href = "employee/dashboard.php";
        } 
        else {
            document.getElementById("msg").innerText = "Invalid Login";
        }
    });
});
</script>

</body>
</html>
