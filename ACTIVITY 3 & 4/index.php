<?php

require_once 'dbcontroller.php';
$dbhandler = new DBController();

if (isset($_POST["register"])) {

    $fname = $dbhandler->verifyData($_POST["person_fname"]);
    $mname = $dbhandler->verifyData($_POST["person_mname"]);
    $lname = $dbhandler->verifyData($_POST["person_lname"]);
    $age = $dbhandler->verifyData($_POST["person_age"]);
    $gender = $dbhandler->verifyData($_POST["person_gender"]);
    $email = $dbhandler->verifyData($_POST["person_email"]);
    $address = $dbhandler->verifyData($_POST["person_address"]);
    $contact_number = $dbhandler->verifyData($_POST["person_contact_number"]);

    $query = "INSERT INTO persons
        (person_fname, person_mname, person_lname, person_age, person_gender, person_email, person_address, person_contact_number)
        VALUES
        ('$fname', '$mname', '$lname', '$age', '$gender', '$email', '$address', '$contact_number')";

    $dbhandler->executeNonQueryIUP($query);

    header("Location: index.php");
    exit;
}

if (isset($_POST["update"])) {

    $person_id = $dbhandler->verifyData($_POST["person_id"]);
    $fname = $dbhandler->verifyData($_POST["person_fname"]);
    $mname = $dbhandler->verifyData($_POST["person_mname"]);
    $lname = $dbhandler->verifyData($_POST["person_lname"]);
    $age = $dbhandler->verifyData($_POST["person_age"]);
    $gender = $dbhandler->verifyData($_POST["person_gender"]);
    $email = $dbhandler->verifyData($_POST["person_email"]);
    $address = $dbhandler->verifyData($_POST["person_address"]);
    $contact_number = $dbhandler->verifyData($_POST["person_contact_number"]);

    $query = "UPDATE persons SET
        person_fname = '$fname',
        person_mname = '$mname',
        person_lname = '$lname',
        person_age = '$age',
        person_gender = '$gender',
        person_email = '$email',
        person_address = '$address',
        person_contact_number = '$contact_number'
        WHERE person_id = '$person_id'";

    $dbhandler->executeNonQueryIUP($query);

    header("Location: index.php");
    exit;
}

if (isset($_GET["delete"])) {

    $person_id = $dbhandler->verifyData($_GET["delete"]);

    $query = "DELETE FROM persons WHERE person_id = '$person_id'";
    $dbhandler->executeNonQueryIUP($query);

    $check = $dbhandler->executeQuery(
        "SELECT COUNT(*) AS total FROM persons"
    );

    if (!empty($check) && $check[0]["total"] == 0) {
        $dbhandler->executeNonQueryIUP(
            "ALTER TABLE persons AUTO_INCREMENT = 1"
        );
    }

    header("Location: index.php");
    exit;
}

$editPerson = null;

if (isset($_GET["edit"])) {

    $person_id = $dbhandler->verifyData($_GET["edit"]);

    $result = $dbhandler->executeQuery(
        "SELECT * FROM persons WHERE person_id = '$person_id'"
    );

    if (!empty($result)) {
        $editPerson = $result[0];
    }
}

$persons = $dbhandler->executeQuery(
    "SELECT * FROM persons ORDER BY person_id ASC"
);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Person Registration</title>

    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="DataTables/datatables.min.css">

</head>

<body>

<div class="container">

    <div class="page-header">
        <h1>Person Registration</h1>
        <p>Register and manage person information</p>
    </div>

    <?php if ($editPerson == null) { ?>

    <div class="form-card">

        <h2>Registration Form</h2>

        <form method="POST" action="index.php">

            <div class="form-grid">

                <div class="form-group">
                    <label>First Name</label>
                    <input
                        type="text"
                        name="person_fname"
                        placeholder="Enter first name"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Middle Name</label>
                    <input
                        type="text"
                        name="person_mname"
                        placeholder="Enter middle name"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Last Name</label>
                    <input
                        type="text"
                        name="person_lname"
                        placeholder="Enter last name"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Age</label>
                    <input
                        type="number"
                        name="person_age"
                        placeholder="Enter age"
                        min="1"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Gender</label>
                    <select name="person_gender" required>
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input
                        type="email"
                        name="person_email"
                        placeholder="Enter email"
                        required
                    >
                </div>

                <div class="form-group full-width">
                    <label>Address</label>
                    <input
                        type="text"
                        name="person_address"
                        placeholder="Enter complete address"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Contact Number</label>
                    <input
                        type="text"
                        name="person_contact_number"
                        placeholder="Enter contact number"
                        required
                    >
                </div>

            </div>

            <div class="form-actions">

                <input
                    type="submit"
                    name="register"
                    value="Register Person"
                >

            </div>

        </form>

    </div>

    <?php } else { ?>

    <div class="form-card">

        <h2>Edit Person</h2>

        <form method="POST" action="index.php">

            <input
                type="hidden"
                name="person_id"
                value="<?php echo htmlspecialchars($editPerson["person_id"]); ?>"
            >

            <div class="form-grid">

                <div class="form-group">
                    <label>First Name</label>
                    <input
                        type="text"
                        name="person_fname"
                        value="<?php echo htmlspecialchars($editPerson["person_fname"]); ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Middle Name</label>
                    <input
                        type="text"
                        name="person_mname"
                        value="<?php echo htmlspecialchars($editPerson["person_mname"]); ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Last Name</label>
                    <input
                        type="text"
                        name="person_lname"
                        value="<?php echo htmlspecialchars($editPerson["person_lname"]); ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Age</label>
                    <input
                        type="number"
                        name="person_age"
                        value="<?php echo htmlspecialchars($editPerson["person_age"]); ?>"
                        min="1"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Gender</label>

                    <select name="person_gender" required>

                        <option value="">Select Gender</option>

                        <option
                            value="Male"
                            <?php if ($editPerson["person_gender"] == "Male") echo "selected"; ?>
                        >
                            Male
                        </option>

                        <option
                            value="Female"
                            <?php if ($editPerson["person_gender"] == "Female") echo "selected"; ?>
                        >
                            Female
                        </option>

                    </select>

                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input
                        type="email"
                        name="person_email"
                        value="<?php echo htmlspecialchars($editPerson["person_email"]); ?>"
                        required
                    >
                </div>

                <div class="form-group full-width">
                    <label>Address</label>
                    <input
                        type="text"
                        name="person_address"
                        value="<?php echo htmlspecialchars($editPerson["person_address"]); ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Contact Number</label>
                    <input
                        type="text"
                        name="person_contact_number"
                        value="<?php echo htmlspecialchars($editPerson["person_contact_number"]); ?>"
                        required
                    >
                </div>

            </div>

            <div class="form-actions">

                <input
                    type="submit"
                    name="update"
                    value="Update Person"
                >

                <a href="index.php" class="cancel-button">
                    Cancel
                </a>

            </div>

        </form>

    </div>

    <?php } ?>

    <div class="table-section">

        <div class="table-header">

            <div>
                <h2>List of Registered Person</h2>
                <p>View, search, edit, or delete registered persons.</p>
            </div>

        </div>

        <div class="table-wrapper">

            <table id="example" class="display">

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Action</th>

                    </tr>

                    <tr class="filter-row">

                        <th>
                            <input
                                type="text"
                                id="filter_id"
                                placeholder="ID"
                            >
                        </th>

                        <th>
                            <input
                                type="text"
                                id="filter_fname"
                                placeholder="First Name"
                            >
                        </th>

                        <th>
                            <input
                                type="text"
                                id="filter_mname"
                                placeholder="Middle Name"
                            >
                        </th>

                        <th>
                            <input
                                type="text"
                                id="filter_lname"
                                placeholder="Last Name"
                            >
                        </th>

                        <th>
                            <input
                                type="text"
                                id="filter_age"
                                placeholder="Age"
                            >
                        </th>

                        <th>
                            <input
                                type="text"
                                id="filter_gender"
                                placeholder="Gender"
                            >
                        </th>

                        <th>
                            <input
                                type="text"
                                id="filter_email"
                                placeholder="Email"
                            >
                        </th>

                        <th>
                            <input
                                type="text"
                                id="filter_address"
                                placeholder="Address"
                            >
                        </th>

                        <th>
                            <input
                                type="text"
                                id="filter_contact"
                                placeholder="Contact"
                            >
                        </th>

                        <th>
                            <button
                                type="button"
                                id="filterButton"
                            >
                                Search
                            </button>
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php if (!empty($persons)) { ?>

                        <?php foreach ($persons as $person) { ?>

                            <tr>

                                <td>
                                    <?php echo htmlspecialchars($person["person_id"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($person["person_fname"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($person["person_mname"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($person["person_lname"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($person["person_age"]); ?>
                                </td>

                                <td>
                                    <span class="gender-badge <?php echo strtolower($person["person_gender"]); ?>">
                                        <?php echo htmlspecialchars($person["person_gender"]); ?>
                                    </span>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($person["person_email"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($person["person_address"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($person["person_contact_number"]); ?>
                                </td>

                                <td class="action-cell">

                                    <a
                                        href="index.php?edit=<?php echo $person["person_id"]; ?>"
                                        class="edit-button"
                                    >
                                        Edit
                                    </a>

                                    <a
                                        href="index.php?delete=<?php echo $person["person_id"]; ?>"
                                        class="delete-button"
                                        onclick="return confirm('Are you sure you want to delete this person?');"
                                    >
                                        Delete
                                    </a>

                                </td>

                            </tr>

                        <?php } ?>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<script src="DataTables/jQuery-3.6.0/jquery-3.6.0.min.js"></script>

<script src="DataTables/datatables.min.js"></script>

<script>

$(document).ready(function() {

    var table = $('#example').DataTable({
        order: [],
        searching: true,
        orderCellsTop: true,
        pageLength: 25
    });

    $('#filterButton').click(function() {

        table
            .column(0).search($('#filter_id').val())
            .column(1).search($('#filter_fname').val())
            .column(2).search($('#filter_mname').val())
            .column(3).search($('#filter_lname').val())
            .column(4).search($('#filter_age').val())
            .column(5).search($('#filter_gender').val())
            .column(6).search($('#filter_email').val())
            .column(7).search($('#filter_address').val())
            .column(8).search($('#filter_contact').val())
            .draw();

    });

    $('#filter_id, #filter_fname, #filter_mname, #filter_lname, #filter_age, #filter_gender, #filter_email, #filter_address, #filter_contact').on('keypress', function(e) {

        if (e.which === 13) {
            $('#filterButton').click();
        }

    });

});

</script>

</body>

</html>