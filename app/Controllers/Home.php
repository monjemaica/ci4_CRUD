<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Students;

class Home extends BaseController
{
    protected $helper = ['url', 'form', 'text', 'html'];

    public function __construct(){

        $this->db = \Config\Database::connect();

    }//End

    //pages
    public function index()
    {
        $student = new Students();
        $data['students'] = $student->where('is_deleted', 0)->findAll();

        return view('home', $data);
    }

    public function add()
    {
        return view('add');
    }
    
    public function edit($id){
        $student = new Students();
        $data['students'] = $student->find($id);
        

        return view('edit', $data);
    }

    //functions
    public function addStudent(){
        $student = new Students();
        
        $data = [
            'first_name' => $this->request->getPost('fname'),
			'last_name'  => $this->request->getPost('lname'),
			'address'  => $this->request->getPost('address'),
			'email'  => $this->request->getPost('email'),
			'mobile'  => $this->request->getPost('mobile')
        ];

        $student->insert($data);

        return redirect()->to('/')->with('add', 'Student Added!');
    }

    public function editStudent(){
        $student = new Students();
        $test = $this->request->getPost();

        $data = [
            'first_name' => $this->request->getPost('fname'),
			'last_name'  => $this->request->getPost('lname'),
			'address'  => $this->request->getPost('address'),
			'email'  => $this->request->getPost('email'),
			'mobile'  => $this->request->getPost('mobile')
        ];

        $student->update($test['id'], $data);

        return redirect()->to('/')->with('update', 'Student Updated!');
    }

    public function deleteStudent(){
        $student = new Students();
        $test = $this->request->getPost();

        $data = [
            'is_deleted' => '1'
        ];

        //$student->where('id', );
        $student->update($test['id'], $data);

       // $sql = "UPDATE students SET `is_deleted` = 1 WHERE id = :id:";
        //$query = $this->db->query($sql, ['id' => $test['id']]);
        //$result = $query->getRowArray(); 

        return json_encode('success');

        //return redirect()->to('/')->with('delete', 'Student Deleted!');
        
    }


}