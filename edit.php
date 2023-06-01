<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "config.php";

if(isset($_POST['submit'])){
  $id = $_POST['id'];
  $schoolname = $_POST['schoolname'];
  $schoolcode = $_POST['schoolcode'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $county = $_POST['county'];
  $principal = $_POST['principal'];

  $sql = "UPDATE `admin` SET `schoolname`='$schoolname', `schoolcode`='$schoolcode', `email`='$email', `password`='$password', `principal`='$principal' WHERE `id`='$id'";

  $result = $conn->query($sql);

  if($result === TRUE){
    echo "Record Updated successfully";
  } else{
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

if(isset($_GET['id'])){
  $userid = $_GET['id'];

  $sql = "SELECT * FROM `admin` WHERE `id`='$userid'";

  $result = $conn->query($sql);

  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      $schoolname = $row['schoolname'];
      $schoolcode = $row['schoolcode'];
      $email = $row['email'];
      $password = $row['password'];
      $county = $row['county'];
      $principal = $row['principal'];
      $id = $row['id'];
    }
  } else {
    // If the 'id' value is not valid, redirect the user back to the view.php page
    header('Location: view.php');
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Data</title>
</head>
<body>
  <h2>Master-Admin Update Form</h2>
  <form action="" method="POST">
    <fieldset>
      <legend>Personal information</legend>
      School Name: <br>
      <input type="text" name="schoolname" value="<?php echo $schoolname; ?>">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <br>
      School Code: <br>
      <input type="text" name="schoolcode" value="<?php echo $schoolcode; ?>">
      <br>
      Email: <br>
      <input type="email" name="email" value="<?php echo $email; ?>">
      <br>
      Password: <br>
      <input type="hidden" name="password" value="<?php echo $password; ?>">
      <br>
      county: <br>
      <input type="text" name="county" value="<?php echo $county; ?>">
      <br>
      principal: <br>
      <input type="text" name="principal" value="<?php echo $principal; ?>">
      <br><br>
      <input type="submit" name="submit" value="Update">
    </fieldset>
  </form>
</body>
</html>
