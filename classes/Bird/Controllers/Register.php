<?php

namespace Bird\Controllers;
use \Natalie\DatabaseTable;

class Register {

    private $userTable;

    public function __construct(DatabaseTable $userTable)
    {
        $this->userTable = $userTable;
    }

    public function registrationForm(){
        return['template' => 'register.html.php',
                'title' => 'Register an account'];
    }

    public function success()
    {
        return[
            'template'=> 'registersuccess.html.php',
            'title' => 'Registration successful'
        ];
    }

    public function registerUser()
    {
        $user = $_POST['user'];
        $valid = true;
        $errors = [];

        if(empty($user['name'])){
            $valid = false;
            $errors[] = 'Name can\'t be blank';
        }
        if(empty($user['email'])){
            $valid = false;
            $errors[] = 'Email can\'t be blank';
        }else if(filter_var($user['email'], FILTER_VALIDATE_EMAIL) == false){
            $valid =false;
            $errors[] = 'Invalid email address';
        }else{
            $user['email'] = strtolower($user['email']);

            if(count($this->userTable->find('email', $user['email']))>0){
                $valid = false;
                $errors[] = 'That email address is already registered';
            }
        }
        if(empty($user['password'])){
            $valid = false;
            $errors[] = 'Password can\'t be blank';
        }

        if($valid){
            $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
            $this->userTable->save($user);
            header('Location: /user/success'); 
        }else{
            return [
                'template' => 'register.html.php',
                'title' => 'Register an account',
                'variables' => [
                    'errors' => $errors,
                    'user' => $user
                ]
            ];
        }
       
    }

}