<?php
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chicken Store - User Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            background-size: cover;
            backdrop-filter: blur(3px);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 20px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        h2 {
            text-align: center;
            color: #e67e22;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #333;
        }

        input, select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 1em;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #e67e22;
            box-shadow: 0 0 5px #e67e22;
        }
        textarea {
        width: 100%;
        font-size: 16px;
        padding: 8px;
        border-radius: 8px;
        }


        button {
            background-color: #e67e22;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 12px;
            width: 100%;
            font-size: 1em;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #d35400;
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
            font-size: 0.9em;
        }

        .login-link a {
            color: #e67e22;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 500px) {
            .container {
                padding: 25px;
                border-radius: 15px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Register to Order Fresh Chicken</h2>
    <form name="registerForm" action="register_check.php" method="POST" onsubmit="return validatePassword();">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

      <label>Email:</label>
        <input type="email" name="email" id="email" required placeholder="e.g. user@example.com" />

        <label>Name:</label>
        <input type="text" name="name" id="name" required pattern="[A-Za-z\s]+" title="Only letters and spaces allowed" placeholder="Enter your name" />

        <label>Phone Number:</label>
        <input type="tel" name="phone" id="phone" required pattern="[0-9]{10}" maxlength="10" title="Enter 10-digit phone number" placeholder="e.g. 9876543210" />

        <label for="address">Address:</label>
        <textarea id="address" name="address" rows="4" required placeholder="Enter your full address here"></textarea>

        <label>State:</label>
        <select name="state" id="state" required onchange="loadCities()">
        <option value="">-- Select State --</option>
        <option value="Karnataka">Karnataka</option>
        </select>

        <label>City:</label>
        <select name="city" id="city" required>
        <option value="">-- Select City --</option>
        </select>

        <label>Password:</label>
        <input type="password" name="password" id="password" required placeholder="Min 6 chars, letters, numbers & symbols" />

        <label>Re-enter Password:</label>
        <input type="password" name="repassword" id="repassword" required placeholder="Re-type password" />

        <button type="submit">Register</button>

    </form>
    <div class="login-link">
        Already have an account? <a href="#">Login</a>
    </div>
</div>

<script>
function loadCities() {
    const state = document.getElementById("state").value;
    const city = document.getElementById("city");
    city.innerHTML = '<option value="">-- Select City --</option>';

    const cities = {
        "Karnataka": [
            "Bagalkot", "Ballari", "Belagavi", "Bengaluru", "Bidar",
            "Chamarajanagar", "Chikkaballapur", "Chikkamagaluru", "Chitradurga",
            "Dakshina Kannada", "Davanagere", "Dharwad", "Gadag", "Hassan",
            "Haveri", "Kalaburagi", "Kodagu", "Kolar", "Koppal", "Mandya",
            "Mysuru", "Raichur", "Ramanagara", "Shivamogga", "Tumakuru",
            "Udupi", "Uttara Kannada", "Vijayapura", "Yadgir"
        ]
    };

    if (cities[state]) {
        cities[state].forEach(function(c) {
            const opt = document.createElement("option");
            opt.value = c;
            opt.textContent = c;
            city.appendChild(opt);
        });
    }
}

function validatePassword() {
    const password = document.getElementById('password').value;
    const repassword = document.getElementById('repassword').value;

    const pwdPattern = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*]).{6,}$/;

    if (!pwdPattern.test(password)) {
        alert('Password must be at least 6 characters and include letters, numbers, and symbols.');
        return false;
    }
    const phone = document.getElementById('phone').value;
    if (!/^\d{10}$/.test(phone)) {
    alert('Phone number must be exactly 10 digits.');
    return false;
}


    if (password !== repassword) {
        alert('Passwords do not match.');
        return false;
    }

    return true;
}
</script>

</body>
</html>
