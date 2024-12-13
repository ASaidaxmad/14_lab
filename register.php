<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header class="bg-light">
    <div class="container py-3">
        <h1 class="mb-0">University Registration</h1>
    </div>
</header>

<section class="py-5">
    <div class="container">
        <h2 class="mb-3">Registration Form</h2>
        <form action="process_registration.php" method="post">
            <div class="mb-3">
                <label for="register-name" class="form-label">Name</label>
                <input type="text" class="form-control" id="register-name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="register-passport" class="form-label">Passport id</label>
                <input type="passport" class="form-control" id="register-passport" name="passport" required>
            </div>
            <div class="mb-3">
                <label for="register-password" class="form-label">Password</label>
                <input type="password" class="form-control" id="register-password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="register-confirm-password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="register-confirm-password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
