<?php

/**
 * PHP Output #5 - Faculty Management System
 * Architecture: Model-View-Controller (MVC)
 * Entry Point: Front Controller
 */

require_once __DIR__ . '/controllers/FacultyController.php';

// Initialize the controller
$controller = new FacultyController();

// Handle the incoming request (GET / POST)
$controller->handleRequest();

?>
