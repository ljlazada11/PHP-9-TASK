<?php require_once(APP_ROOT . '/views/includes/header.php'); ?>

<?php print_r(isset($data) ? $data : null);?>

<div class="navbar">
    <a href="#" class="active">Registration</a>
    <a href="#">View Data</a>
</div>

<div class="form-container">
    <div class="form-header">Student's Registration Form</div>
    <div class="form-body">
        <form method="POST" action="" id="frmInsert">
            <div class="form-group">
                <label>First Name:</label>
                <input type="text" name="first_name" placeholder="Enter First Name">
            </div>

            <div class="form-group">
                <label>Middle Name:</label>
                <input type="text" name="middle_name" placeholder="Enter Middle Name">
            </div>

            <div class="form-group">
                <label>Last Name:</label>
                <input type="text" name="last_name" placeholder="Enter Last Name">
            </div>

            <div class="form-group">
                <label>Gender:</label>
                <select name="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <button type="submit" class="btn btn-submit">Submit</button>
            <button type="button" class="btn btn-cancel">Cancel</button>
        </form>
    </div>
</div>

<?php require_once('./views/includes/scripts/mandatory_script.php');?>
<?php require_once('./views/includes/scripts/main_script.php');?>
<?php require_once(APP_ROOT . '/views/includes/footer.php'); ?>