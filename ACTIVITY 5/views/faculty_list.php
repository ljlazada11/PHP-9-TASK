    <div class="table-card">

        <div class="table-header">
            <h2>Faculty Records List</h2>
            <p>View, manage, edit, and delete faculty members</p>
        </div>

        <div class="table-wrapper">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Position</th>
                        <th>Salary</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($facultyList)) { ?>
                        <?php foreach ($facultyList as $faculty) { ?>
                            <tr>
                                <td><strong>#<?php echo htmlspecialchars($faculty['faculty_id']); ?></strong></td>
                                <td><?php echo htmlspecialchars($faculty['first_name']); ?></td>
                                <td><?php echo htmlspecialchars(!empty($faculty['middle_name']) ? $faculty['middle_name'] : '-'); ?></td>
                                <td><?php echo htmlspecialchars($faculty['last_name']); ?></td>
                                <td><?php echo htmlspecialchars($faculty['age']); ?></td>
                                <td><?php echo htmlspecialchars($faculty['gender']); ?></td>
                                <td><?php echo htmlspecialchars($faculty['position']); ?></td>
                                <td>₱<?php echo number_format((float)$faculty['salary'], 2); ?></td>
                                <td><?php echo htmlspecialchars($faculty['address']); ?></td>
                                <td class="action-cell">
                                    <a
                                        href="index.php?action=edit&id=<?php echo urlencode($faculty['faculty_id']); ?>"
                                        class="btn-sm btn-edit"
                                    >
                                        Edit
                                    </a>
                                    <a
                                        href="index.php?action=delete&id=<?php echo urlencode($faculty['faculty_id']); ?>"
                                        class="btn-sm btn-delete"
                                        onclick="return confirm('Are you sure you want to delete faculty member <?php echo htmlspecialchars(addslashes($faculty['first_name'] . ' ' . $faculty['last_name'])); ?>?');"
                                    >
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="10" class="empty-state">
                                No faculty records found. Use the form above to add the first faculty member!
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>

</div> <!-- end container -->

</body>
</html>
