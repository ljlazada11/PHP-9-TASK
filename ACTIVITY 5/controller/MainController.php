<?php 

require_once('./models/MainModel.php');

class MainController {
    private $model;

    public function __construct() {
        $this->model = new MainModel();
    }

    public function index() {
        $active = 'index';
        require_once('./views/main/index.php');
    }

    public function display() {
        $active = 'display';
        $data = $this->model->getAllRecords();
        require_once('./views/main/display.php');
    }

    public function register($data = []) {
        $record = [];

        // transfer all POST data to a new array variable, as one record
        // trim all data
        foreach($data['data'] as $value) {
            $record[$value['name']] = trim(htmlspecialchars($value['value']));
        }
    
        if($this->model->register($record)){
            echo 'Successfully Saved!';
        }
        
    }

    public function getStudentData($id) {
        if($this->model->getStudentData($id)) {
            $data = $this->model->getStudentData($id);
            echo json_encode($data);
        }
    }

    public function edit($data = []) {
        $record = [];

        foreach ($data['data'] as $value) {
            $record[$value['name']] = trim(htmlspecialchars($value['value']));
        }

        if($this->model->edit($record)) {
            echo 'Successfully Edited!';
        }
    }

    public function delete($id) {
        if($this->model->delete($id)) {
            echo 'Successfully Deleted!';
        }
    }
}