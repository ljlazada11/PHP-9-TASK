<?php

require_once __DIR__ . '/../models/Faculty.php';

class FacultyController {

    private $model;

    public function __construct() {
        $this->model = new Faculty();
    }

    // Main request router inside the controller
    public function handleRequest() {
        $requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        // Handle POST actions (Create, Update)
        if ($requestMethod === 'POST') {
            $action = isset($_POST['action']) ? $_POST['action'] : '';

            if ($action === 'create') {
                $this->create();
                return;
            } elseif ($action === 'update') {
                $this->update();
                return;
            }
        }

        // Handle GET actions (Delete, Edit, or Index)
        $action = isset($_GET['action']) ? $_GET['action'] : '';

        if ($action === 'delete' && isset($_GET['id'])) {
            $this->delete($_GET['id']);
            return;
        } elseif ($action === 'edit' && isset($_GET['id'])) {
            $this->edit($_GET['id']);
            return;
        }

        // Default view: Display list and blank form
        $this->index();
    }

    // Display all faculty records and the registration form
    public function index($errors = [], $formData = []) {
        $facultyList = $this->model->getAll();
        $isEdit = false;
        $statusMessage = $this->getStatusMessage();

        require __DIR__ . '/../views/faculty_form.php';
        require __DIR__ . '/../views/faculty_list.php';
    }

    // Process new faculty form submission
    public function create() {
        $errors = $this->validate($_POST);

        if (!empty($errors)) {
            $facultyList = $this->model->getAll();
            $formData = $_POST;
            $isEdit = false;
            $statusMessage = null;

            require __DIR__ . '/../views/faculty_form.php';
            require __DIR__ . '/../views/faculty_list.php';
            return;
        }

        $this->model->create($_POST);
        header("Location: index.php?status=created");
        exit;
    }

    // Prepare the edit form with existing faculty data
    public function edit($id) {
        $faculty = $this->model->getById($id);

        if (!$faculty) {
            header("Location: index.php?status=notfound");
            exit;
        }

        $facultyList = $this->model->getAll();
        $formData = $faculty;
        $isEdit = true;
        $errors = [];
        $statusMessage = null;

        require __DIR__ . '/../views/faculty_form.php';
        require __DIR__ . '/../views/faculty_list.php';
    }

    // Process update submission
    public function update() {
        $id = isset($_POST['faculty_id']) ? $_POST['faculty_id'] : 0;
        $errors = $this->validate($_POST);

        if (!empty($errors)) {
            $facultyList = $this->model->getAll();
            $formData = $_POST;
            $isEdit = true;
            $statusMessage = null;

            require __DIR__ . '/../views/faculty_form.php';
            require __DIR__ . '/../views/faculty_list.php';
            return;
        }

        $this->model->update($id, $_POST);
        header("Location: index.php?status=updated");
        exit;
    }

    // Process faculty record deletion
    public function delete($id) {
        $this->model->delete($id);
        header("Location: index.php?status=deleted");
        exit;
    }

    // Server-side validation for all 8 required fields
    private function validate($data) {
        $errors = [];

        // 1. First Name
        if (empty(trim($data['first_name'] ?? ''))) {
            $errors[] = "First Name is required.";
        } elseif (!preg_match("/^[a-zA-Z\s\-\.\']+$/", trim($data['first_name']))) {
            $errors[] = "First Name must only contain letters, spaces, and hyphens.";
        }

        // 2. Middle Name (Optional, but if provided must contain valid characters)
        if (!empty(trim($data['middle_name'] ?? ''))) {
            if (!preg_match("/^[a-zA-Z\s\-\.\']+$/", trim($data['middle_name']))) {
                $errors[] = "Middle Name must only contain letters, spaces, and hyphens.";
            }
        }

        // 3. Last Name
        if (empty(trim($data['last_name'] ?? ''))) {
            $errors[] = "Last Name is required.";
        } elseif (!preg_match("/^[a-zA-Z\s\-\.\']+$/", trim($data['last_name']))) {
            $errors[] = "Last Name must only contain letters, spaces, and hyphens.";
        }

        // 4. Age
        if (empty(trim($data['age'] ?? ''))) {
            $errors[] = "Age is required.";
        } elseif (!filter_var($data['age'], FILTER_VALIDATE_INT) || (int)$data['age'] < 18 || (int)$data['age'] > 100) {
            $errors[] = "Age must be a valid whole number between 18 and 100.";
        }

        // 5. Gender
        $allowedGenders = ['Male', 'Female', 'Other'];
        if (empty($data['gender'] ?? '')) {
            $errors[] = "Gender is required.";
        } elseif (!in_array($data['gender'], $allowedGenders)) {
            $errors[] = "Please select a valid gender option.";
        }

        // 6. Address
        if (empty(trim($data['address'] ?? ''))) {
            $errors[] = "Address is required.";
        }

        // 7. Position
        if (empty(trim($data['position'] ?? ''))) {
            $errors[] = "Position is required.";
        }

        // 8. Salary
        if (!isset($data['salary']) || trim($data['salary']) === '') {
            $errors[] = "Salary is required.";
        } elseif (!is_numeric($data['salary']) || (float)$data['salary'] <= 0) {
            $errors[] = "Salary must be a positive number.";
        }

        return $errors;
    }

    // Helper for flash feedback messages
    private function getStatusMessage() {
        if (!isset($_GET['status'])) {
            return null;
        }

        switch ($_GET['status']) {
            case 'created':
                return ['type' => 'success', 'text' => 'Faculty record added successfully!'];
            case 'updated':
                return ['type' => 'success', 'text' => 'Faculty record updated successfully!'];
            case 'deleted':
                return ['type' => 'success', 'text' => 'Faculty record deleted successfully!'];
            case 'notfound':
                return ['type' => 'error', 'text' => 'Faculty record not found.'];
            default:
                return null;
        }
    }
}

?>
