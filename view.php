<?php
include "config.php";
$sql = "SELECT *FROM admin";

$result = $conn->query($sql)

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <title>View page</title>
</head>
<body>
<div class="container">
    <h2>Schools</h2>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>School Name</th>
          <th>School Code</th>
          <th>School Email Adress</th>
          <th>School county</th>
          <th>School Principal Name</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['schoolname'] . "</td>";
            echo "<td>" . $row['schoolcode'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['county'] . "</td>";
            echo "<td>" . $row['principal'] . "</td>";
            echo "<td>

                  <a class='btn btn-info'  href='edit.php?id=" . $row['id'] . "'>Edit</a>

                  <a class='btn btn-danger' href='delete.php?id=" . $row['id'] . "'>Delete</a>
                  </td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='6'>No users found</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>