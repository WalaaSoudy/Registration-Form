<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Sanitize user inputs to prevent SQL injection attacks
$full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
$username = mysqli_real_escape_string($conn, $_POST['user_name']);
$birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$password = password_hash(mysqli_real_escape_string($conn, $_POST['password']), PASSWORD_DEFAULT);
$email = mysqli_real_escape_string($conn, $_POST['email']);

// Check if the username already exists
$sql = "SELECT * FROM test WHERE username='$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  echo "Username already exists. Please choose another username.";
} else {
  // Upload the user image to the server
  $user_image = "";
  if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] == 0) {
    // Ensure the images folder exists and has write permissions
    $dirpath = 'C:\xampp\htdocs\images\\';
    if (!is_dir($dirpath)) {
      mkdir($dirpath, 0755, true);
    }

    // Generate a unique name for the uploaded file
    $temp = explode(".", $_FILES["user_image"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);

    // Move the uploaded file to the images folder
    if (move_uploaded_file($_FILES['user_image']['tmp_name'], $dirpath.'/'.$newfilename)) {
      $user_image = $newfilename;
    } else {
      echo "Error uploading file.";
    }
  }

  // Insert the user data into the database
  $query = "INSERT INTO test (fullname, username, birthdate, phone, address, password, email, userimage) VALUES ('$full_name', '$username', '$birthdate', '$phone', '$address', '$password', '$email', '$user_image')";
  
  if (mysqli_query($conn, $query)) {
    echo "New record created successfully.";
  } else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
  }
}

mysqli_close($conn);
?>
