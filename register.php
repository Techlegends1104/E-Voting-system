<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login(User)</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to bottom right, #f0f4f8, #e6edf5);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container-box {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            max-width: 460px;
            width: 100%;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            border-top: 6px solid #0F3D8C;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 22px;
            color: #0F3D8C;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 14px;
            color: #555;
        }

        .btn-custom {
            background: linear-gradient(to right, #0F3D8C, #1E90FF);
            border: none;
            font-weight: 600;
            transition: background 0.3s ease;
        }

        .btn-custom:hover {
            background: linear-gradient(to right, #1E90FF, #0F3D8C);
        }

        .emblem {
            width: 60px;
            margin-bottom: 10px;
        }

        #otp-section {
            display: none;
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            font-size: 13px;
            color: #777;
        }
    </style>
</head>

<body>

    <div class="container container-box">
        <div class="header">
            <img src="Emblem_of_India.svg"
                alt="National Emblem" class="emblem">
            <h1>Voter Identity Verification</h1>
            <p>Election Commission of India</p>
        </div>

        <!-- Voter Details Form -->
        <form id="verification-form" method="post">
    <div class="mb-3">
        <input type="text" class="form-control" id="name" name="name" placeholder="Full Name (as per Aadhar)" required>
    </div>
    <div class="mb-3">
        <input type="number" class="form-control" id="Aadhar" name="Aadhar" placeholder="Enter Aadhar" required>
    </div>
    <div class="mb-3">
        <input type="number" class="form-control" id="voterId" name="voterId" placeholder="Voter ID Number" required>
    </div>
    <div class="mb-3">
        <input type="date" class="form-control" id="dob" name="dob" placeholder="Date of Birth (DD-MM-YYYY)" required>
    </div>
    <div class="mb-3">
        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Submit</button>
</form>
        <p style="text-align:center;margin-top:20px;">Have an account? <a href="login.html">Login</a></p>
        <div class="footer">
            This service is provided under the guidelines of the Election Commission of India 🇮🇳
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }

        function checkPasswordStrength() {
            const password = document.getElementById("password").value;
            const strengthText = document.getElementById("password-strength");
            const registerButton = document.getElementById("register-btn");

            const strongRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            const mediumRegex = /^(?=.*[A-Z])(?=.*\d)[A-Za-z\d@$!%*?&]{6,}$/;

            if (password.length < 8) {
                strengthText.innerHTML = "❌ Too short (Min: 8 chars)";
                strengthText.style.color = "red";
                registerButton.disabled = true;
            } else if (strongRegex.test(password)) {
                strengthText.innerHTML = "✅ Strong Password";
                strengthText.style.color = "green";
                registerButton.disabled = false;
            } else if (mediumRegex.test(password)) {
                strengthText.innerHTML = "⚠️ Medium Password (Add special character)";
                strengthText.style.color = "orange";
                registerButton.disabled = true;
            } else {
                strengthText.innerHTML = "❌ Weak Password (Use uppercase, number & special char)";
                strengthText.style.color = "red";
                registerButton.disabled = true;
            }
        }

        function validateConfirmPassword() {
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirm_password").value;
            const confirmMessage = document.getElementById("confirm-password-message");
            const registerButton = document.getElementById("register-btn");

            if (confirmPassword === password) {
                confirmMessage.innerHTML = "✅ Passwords match";
                confirmMessage.style.color = "green";
                registerButton.disabled = false;
            } else {
                confirmMessage.innerHTML = "❌ Passwords do not match";
                confirmMessage.style.color = "red";
                registerButton.disabled = true;
            }
        }
    </script>
    <?php 
    include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $aadhar = $_POST['Aadhar'];
    $voterId = $_POST['voterId'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];

    // Prepare statement
    $stmt = $conn->prepare("INSERT INTO voter_registration (name, aadhar, voter_id, dob, phone) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $aadhar, $voterId, $dob, $phone);

    // Execute and give feedback
    if ($stmt->execute()) {
        echo "<script>alert('Verification data submitted successfully!');</script>";
    } else {
        echo "<script>alert('Submission failed. Please try again.');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

</body>

</html>