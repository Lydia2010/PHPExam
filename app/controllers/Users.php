<?php
class Users extends Controller {
    public function __construct(){
        $this->userModel = $this->model('User');

    }

    public function register(){
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data =[
                'name' => trim($_POST['name']),
                'age' => trim($_POST['age']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'age_err' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            echo ($_POST['name']);
            echo ($_POST['age']);
            // Validate Email
            if(empty($data['email'])){
                $data['email_err'] = 'Please enter email';
            }else{
                //Check email
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err']='Email is already taken';
                }
            }

            // Validate Name
            if(empty($data['name'])){
                $data['name_err'] = 'Please enter name';
            }
            // Validate age
            if(empty($data['age'])){
                $data['age_err'] = 'Please enter age';
            }elseif(($data['age']) < 1){
                $data['age_err'] = 'Age must be >0';
        }

            // Validate Password
            if(empty($data['password'])){
                $data['password_err'] = 'Please enter password';
            } elseif(strlen($data['password']) < 8){
                $data['password_err'] = 'Password must be at least 8 characters';
            }

            // Validate Confirm Password
            if(empty($data['confirm_password'])){
                $data['confirm_password_err'] = 'Please confirm password';
            } else {
                if($data['password'] != $data['confirm_password']){
                    $data['confirm_password_err'] = 'Passwords do not match';
                }
            }

            // Make sure errors are empty
            if(empty($data['email_err']) && empty($data['age_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
                // Validated
                die('SUCCESS');
            } else {
                // Load view with errors
                $this->view('../views/users/register', $data);
            }

        } else {
            // Init data
            $data =[
                'name' => '',
                'age' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Load view

            $this->view('../views/users/register', $data);
        }
    }

    public function login(){
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data =[
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            ];

            // Validate Email
            if(empty($data['email'])){
                $data['email_err'] = 'Please enter email';
            }

            // Validate Password
            if(empty($data['password'])){
                $data['password_err'] = 'Please enter password';
            }

            // Make sure errors are empty
            if(empty($data['email_err']) && empty($data['password_err'])){
                // Validated
                die('SUCCESS');
            } else {
                // Load view with errors
                $this->view('../views/users/login', $data);
            }


        } else {
            // Init data
            $data =[
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];

            // Load view
            $this->view('../views/users/login', $data);
        }
    }
    public function registerAjax(){
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest'){
            echo "in ajax call";
        }



        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "post request ajax";
            if (isset($_POST["submit"])) {
                //check they are set later
                $name = $_POST["name"];
                $password = $_POST["password"];

                //how do we reference the model
                $model=$this->model("AccountModel");
                $success=$model->createAccount($name,$password);

                if($success){
                    echo "successfully inserted";
                    $model->displayAccount($name,$password);
                }
                else{
                    echo "insert failed";
                }


            }
        } else {

            return $this->view("users/registerAjax");
        }
    }

}