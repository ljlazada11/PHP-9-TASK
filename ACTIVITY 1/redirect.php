<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $req_type = '$_GET';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $req_type = '$_POST';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>PHP Output No. 1</title>
</head>

<body>

<div class="redirect-container">

    <h2>Submitted Data</h2>

    <p>
        Data is sent here, and it is stored at
        <b><?php echo $req_type; ?></b> variable.
    </p>

    <table>
        <tr>
            <td>First Name:</td>
            <td><?php echo ($req_type == '$_GET') ? $_GET['fname'] : $_POST['fname']; ?></td>
        </tr>

        <tr>
            <td>Middle Name:</td>
            <td><?php echo ($req_type == '$_GET') ? $_GET['mname'] : $_POST['mname']; ?></td>
        </tr>

        <tr>
            <td>Last Name:</td>
            <td><?php echo ($req_type == '$_GET') ? $_GET['lname'] : $_POST['lname']; ?></td>
        </tr>

        <tr>
            <td>Age:</td>
            <td><?php echo ($req_type == '$_GET') ? $_GET['age'] : $_POST['age']; ?></td>
        </tr>

        <tr>
            <td>Gender:</td>
            <td><?php echo ($req_type == '$_GET') ? $_GET['gender'] : $_POST['gender']; ?></td>
        </tr>

        <tr>
            <td>Email:</td>
            <td><?php echo ($req_type == '$_GET') ? $_GET['email'] : $_POST['email']; ?></td>
        </tr>

        <tr>
            <td>Address:</td>
            <td><?php echo ($req_type == '$_GET') ? $_GET['address'] : $_POST['address']; ?></td>
        </tr>

        <tr>
            <td>Contact Number:</td>
            <td><?php echo ($req_type == '$_GET') ? $_GET['contact'] : $_POST['contact']; ?></td>
        </tr>
    </table>

    <a href="./">Return to Main Form</a>

</div>

</body>
</html>