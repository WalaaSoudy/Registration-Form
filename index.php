<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="style.css"/>
	</head>
<body>
<?php include 'header.php';?>
<form  id="registration-form" action="DB_Ops.php" method="post enctype="multipart\form-data">
<label for="full_name">Full Name:</label><br>
		<input type="text" id="full_name" name="full_name" required><br>

		<label for="user_name">User Name:</label><br>
		<input type="text" id="user_name" name="user_name" required><br>

		<label for="birthdate">Birthdate:</label><br>
		<input type="date" id="birthdate" name="birthdate" required><br>

		<label for="phone">Phone:</label><br>
		<input type="tel" id="phone" name="phone" required><br>

		<label for="address">Address:</label><br>
		<input type="text" id="address" name="address" required><br>

		<label for="password">Password:</label><br>
		<input type="password" id="password" name="password" required><br>

		<label for="confirm_password">Confirm Password:</label><br>
		<input type="password" id="confirm_password" name="confirm_password" required><br>

		<label for="user_image">User Image:</label><br>
		<input type="file" id="user_image" name="user_image" enctype="multipart/form-data" required><br>

		<label for="email">Email:</label><br>
		<input type="email" id="email" name="email" required><br>

		<button type="submit">Submit</button>
</form>
<script>
		const form = document.getElementById("registration-form");
		const fullNameInput = document.getElementById("full_name");
		const userNameInput = document.getElementById("user_name");
		const birthdateInput = document.getElementById("birthdate");
		const passwordInput = document.getElementById("password");
		const confirmPasswordInput = document.getElementById("confirm_password");
		const emailInput = document.getElementById("email");

		form.addEventListener("submit", (event) => {
			event.preventDefault();

			if (!validateFullName(fullNameInput.value)) {
				alert("Please enter a valid full name.");
				return;
			}

			if (!validateEmail(emailInput.value)) {
				alert("Please enter a valid email address.");
				return;
			}

			if (!validateBirthdate(birthdateInput.value)) {
				alert("Please enter a valid birthdate.");
				return;
			}

			if (!validatePassword(passwordInput.value, confirmPasswordInput.value)) {
				alert("Password must be at least 8 characters long and contain at least 1 number and 1 special character.");
				return;
			}

			form.submit();
		});

		function validateFullName(fullName) {
			// Full Name should have only alphabets and spaces
			const regex = /^[a-zA-Z\s]*$/;
			return regex.test(fullName);
		}

		function validateEmail(email) {
			// Email should be in correct format
			const regex = /\S+@\S+\.\S+/;
			return regex.test(email);
		}

		function validateBirthdate(birthdate) {
			// Birthdate should be in the past
			return new Date(birthdate) < new Date();
		}

		function validatePassword(password, confirmPassword) {
			// Password should be at least 8 characters with at least 1 number and 1 special character
			const regex = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
			return regex.test(password) && password === confirmPassword;
		}
	</script>
  <?php include 'footer.php';?>
</body>
</html>