<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Management (MVC) - PHP Output #5</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <div class="page-header">
        <h1>Faculty Management System</h1>
        <p>PHP Output #5 &bull; Model-View-Controller (MVC) CRUD Operations</p>
    </div>

    <?php if (!empty($statusMessage)) { ?>
        <div class="alert alert-<?php echo htmlspecialchars($statusMessage['type']); ?>">
            <?php echo htmlspecialchars($statusMessage['text']); ?>
        </div>
    <?php } ?>

    <?php if (!empty($errors)) { ?>
        <div class="alert alert-error">
            <strong>Please fix the following validation errors:</strong>
            <ul>
                <?php foreach ($errors as $error) { ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>

    <div class="form-card">
        <h2><?php echo $isEdit ? 'Edit Faculty Member' : 'Add New Faculty Member'; ?></h2>

        <form method="POST" action="index.php">

            <input type="hidden" name="action" value="<?php echo $isEdit ? 'update' : 'create'; ?>">

            <?php if ($isEdit && isset($formData['faculty_id'])) { ?>
                <input type="hidden" name="faculty_id" value="<?php echo htmlspecialchars($formData['faculty_id']); ?>">
            <?php } ?>

            <div class="form-grid">

                <div class="form-group">
                    <label>First Name <span class="required">*</span></label>
                    <input
                        type="text"
                        name="first_name"
                        placeholder="Enter first name"
                        value="<?php echo htmlspecialchars($formData['first_name'] ?? ''); ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Middle Name</label>
                    <input
                        type="text"
                        name="middle_name"
                        placeholder="Enter middle name (optional)"
                        value="<?php echo htmlspecialchars($formData['middle_name'] ?? ''); ?>"
                    >
                </div>

                <div class="form-group">
                    <label>Last Name <span class="required">*</span></label>
                    <input
                        type="text"
                        name="last_name"
                        placeholder="Enter last name"
                        value="<?php echo htmlspecialchars($formData['last_name'] ?? ''); ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Age <span class="required">*</span></label>
                    <input
                        type="number"
                        name="age"
                        placeholder="Enter age (18 - 100)"
                        min="18"
                        max="100"
                        value="<?php echo htmlspecialchars($formData['age'] ?? ''); ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Gender <span class="required">*</span></label>
                    <select name="gender" required>
                        <option value="">-- Select Gender --</option>
                        <option value="Male" <?php if (($formData['gender'] ?? '') === 'Male') echo 'selected'; ?>>Male</option>
                        <option value="Female" <?php if (($formData['gender'] ?? '') === 'Female') echo 'selected'; ?>>Female</option>
                        <option value="Other" <?php if (($formData['gender'] ?? '') === 'Other') echo 'selected'; ?>>Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Position <span class="required">*</span></label>
                    <input
                        type="text"
                        name="position"
                        placeholder="e.g. Instructor, Assistant Professor"
                        value="<?php echo htmlspecialchars($formData['position'] ?? ''); ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Salary (₱) <span class="required">*</span></label>
                    <input
                        type="number"
                        name="salary"
                        step="0.01"
                        min="0"
                        placeholder="e.g. 35000.00"
                        value="<?php echo htmlspecialchars($formData['salary'] ?? ''); ?>"
                        required
                    >
                </div>

                <div class="form-group full-width">
                    <label>Address <span class="required">*</span></label>
                    <textarea
                        name="address"
                        rows="3"
                        placeholder="Enter complete address"
                        required
                    ><?php echo htmlspecialchars($formData['address'] ?? ''); ?></textarea>
                </div>

            </div>

            <div class="form-actions">
                <?php if ($isEdit) { ?>
                    <button type="submit" class="btn btn-update">Update Faculty</button>
                    <a href="index.php" class="btn btn-cancel">Cancel</a>
                <?php } else { ?>
                    <button type="submit" class="btn btn-primary">Add Faculty</button>
                <?php } ?>
            </div>

        </form>
    </div>
