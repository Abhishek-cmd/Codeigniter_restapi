<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class ApiEmployeeController extends RestController {

	public function __construct(){
       parent::__construct();
       $this->load->model('Employee_model');
	}

	public function index_get()
	{
		$employee = new Employee_model;
		$result_emp = $employee->get_employees();
		$this->response($result_emp, 200);
	}

	public function storeEmployee_post(){
		$employee = new Employee_model;

		$data = [
			'name' => $_POST['name'],
			'gender' => $_POST['gender'],
			'age' => $_POST['age'],
			'created_at' => date('Y-m-d H:i:s')
		];

		$result = $employee->insert_employees($data);

		if($result > 0){
			$this->response([
				'status' => true,
				'message' => 'New employee added successfully'
			], RestController:: HTTP_OK);
		}else{
            $this->response([
				'status' => false,
				'message' => 'FAILED TP CREATE New employee'
			], RestController:: HTTP_BAD_REQUEST);
		}

		$this->response($result, 200);
	}

	public function findEmployee_get($id){
        $employee = new Employee_model;
        $result_emp = $employee->edit_employees($id);
		$this->response($result_emp, 200);
	}

	public function updateEmployee_put($id){
        $employee = new Employee_model;

		$data = [
			'name' => $this->put('name'),
			'gender' => $this->put('gender'),
			'age' => $this->put('age'),
			'created_at' => date('Y-m-d H:i:s')
		];

		$result = $employee->update_employees($id,$data);

		if($result > 0){
			$this->response([
				'status' => true,
				'message' => 'Employee updated successfully'
			], RestController:: HTTP_OK);
		}else{
            $this->response([
				'status' => false,
				'message' => 'FAILED TP UPDATE employee'
			], RestController:: HTTP_BAD_REQUEST);
		}

		$this->response($result, 200);
	}

	public function deleteEmployee_delete($id){
        $employee = new Employee_model;
        $result_emp = $employee->delete_employees($id);

        if($result_emp > 0){
			$this->response([
				'status' => true,
				'message' => 'Employee deleted successfully'
			], RestController:: HTTP_OK);
		}else{
            $this->response([
				'status' => false,
				'message' => 'FAILED TP delete employee'
			], RestController:: HTTP_BAD_REQUEST);
		}

		$this->response($result, 200);
	}
}