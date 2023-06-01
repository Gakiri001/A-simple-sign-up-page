<?php
//define variables and set them to empty
$schoolnameErr=$schoolcodeErr=$countyErr=$principalErr=$emailErr=$passwordErr="";
$schoolname=$schoolcode=$county=$principal=$email=$password="";

if($_SERVER["REQUEST_METHOD"]=="POST"){

    if(empty($_POST["schoolname"])){
        $schoolnameErr = "You must enter a valid school name";
    }
    else{
      $schoolname = test_input($_POST["schoolname"]);
        if(!preg_match("/^[a-zA-Z']*$/",$schoolname)){
          $schoolnameErr = "Only letters and white spaces are allowed";
        }
     }

    if(empty($_POST["schoolcode"])){
      $schoolcodeErr = "You must enter a valid school code";
    }
    else{
      $schoolcode = test_input($_POST["schoolcode"]);
      if (!preg_match("/^[0-9]+$/", $schoolcode)){
        $schoolcodeErr = "Only numbers(integers) allowed";
    }
    }

    if(empty($_POST["email"])){
      $emailErr = "You must enter a valid school email";
    }
    else{
      $email = test_input($_POST["email"]);
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $emailErr = "The emaol is incorrect";
    }
    }

    if(empty($_POST["password"])){
      $passwordErr = "You must enter password";
    }
    else{
      $password = test_input($_POST["password"]);
      if (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#$%^&+=!])(?=.*[a-zA-Z\d@#$%^&+=!]).{8,}$/", $password)){
        $passwordErr = "Enter a school a strong password";
    }
    }

    if(empty($_POST["county"])){
      $countyErr = "Enter where your school is located";
  }
  else{
    $county = test_input($_POST["county"]);
      if(!preg_match("/^[a-zA-Z']*$/",$county)){
        $countyErr = "Only letters and white spaces are allowed";
      }
   }
   if(empty($_POST["principal"])){
    $principalErr = "Enter the institution Principal";
}
else{
  $principal = test_input($_POST["principal"]);
    if(!preg_match("/^[a-zA-Z']*$/",$principal)){
      $principalErr = "Only letters and white spaces are allowed";
    }
 }
}
function test_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  }

?>

<?php
include "config.php";

//values to be taken when submit button is clicked
if(isset($_POST['submit'])){
  $schoolname= $_POST['schoolname'];
  $schoolcode= $_POST['schoolcode'];
  $county= $_POST['county'];
  $principal= $_POST['principal'];
  $email= $_POST['email'];
  $password= $_POST['password'];
}

$sql = "INSERT INTO  `admin` (`schoolname`,`schoolcode`,`county`,`principal`,`email`,`password`) VALUES ('$schoolname','$schoolcode','$county','$principal','$email','$password')";

$result = $conn -> query($sql);
if($result==true){
  echo "New records created successfully";
}
else {
  echo "ERROR: " . $sql . "<br>" . $conn -> error;
}

$conn -> close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up page</title>
  <style>
    form,h2{
      display: flex;
      justify-content: center;
    }
    fieldset{
      width: 500px;
      height: 460px;
    }
    .i{
      width: 250px;
      height: 25px;
      border: 1px solid black;
      border-radius: 7px;
  }
  .submit{
    width: 200px;
    height: 25px;
    border: none;
    border-radius: 7px;
    background-color: red;
    color: white;
    display: flex;
    justify-content: center;
    cursor: pointer;
  }
  .Error{
      color: #FF0000;
    }
  </style>
</head>
<body>
  <h2>
    Sign up to create account for Admin
  </h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    <fieldset>
      <legend>Institution Details</legend>
      <br>
    Name of the Institution: <br>
    <input class="i" type="text" name="schoolname" >
    <span class="Error">* <?php echo $schoolnameErr;?></span>
    <br> <br>
    School Code: <br>
    <input class="i" type="text" name="schoolcode">
    <span class="Error">* <?php echo $schoolcodeErr;?></span>
    <br> <br>
    School's county: <br>
    <input class="i" type="text" name="county">
    <span class="Error">* <?php echo $countyErr;?></span>
    <br> <br>
    School's Principal: <br>
    <input class="i" type="text" name="principal">
    <span class="Error">* <?php echo $principalErr;?></span>
    <br> <br>
    School Email Address: <br>
    <input class="i" type="text" name="email">
    <span class="Error">* <?php echo $emailErr;?></span>
    <br> <br>
    password: <br>
    <input class="i" type="password" name="password"><span class="Error">* <?php echo $passwordErr;?></span>
    <br> <br> <br>
    <input class="submit" type="submit" name="submit" value="create school account">
    </fieldset>
 
  </form>
</body>
</html>