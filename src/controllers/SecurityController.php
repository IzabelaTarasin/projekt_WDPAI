<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController
{
    private UserRepository $userRepository;

    public function __construct()
    {
        parent::__construct();

        $this->userRepository = new UserRepository();
    }

    public function login()
    {
        if ($this->isPost()) {
            try {
                $email = $_POST["email"];
                $password = $_POST["password"];

                if($email == null)
                    throw new Exception('Email is required');

                if($password == null)
                    throw new Exception('Password is required');

                $user = $this->userRepository->getUser($email);
                if($user == null)
                    throw new Exception('Invalid username or password');

                if($user->getEmail() !== $email)
                    throw new Exception('User does not exists');

                if(!password_verify($password, $user->getPassword())){
                    throw new Exception('Invalid username or password');
                }

                $_SESSION['user'] = $user;
                $url = "http://$_SERVER[HTTP_HOST]";
                header("Location: {$url}");
            } catch (Exception $e) {
                $this->render('login', ['messages' => [$e->getMessage()]]);
            }
        } else {
            $this->render('login');
        }
    }

    public function register()
    {
         if ($this->isPost()) {
            try {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $confirmedPassword = $_POST['confirmedPassword'];
                $name = $_POST['name'];
                $surname = $_POST['surname'];
                $accountType = $_POST['accountType'];

                if($email == null)
                    throw new Exception('Email is required');

                if($password == null)
                    throw new Exception('Password is required');

                if($name == null)
                    throw new Exception('Name is required');

                if($surname == null)
                    throw new Exception('Surname is required');

                if($accountType == null)
                    throw new Exception('AccountType is required');

                if ($password !== $confirmedPassword) {
                    throw new Exception('Passwords do not match');
                }

                $existingUser = $this->userRepository->getUser($email);

                if($existingUser != null)
                    throw new Exception('You already have an account');

                $hash = password_hash($password, PASSWORD_DEFAULT);
                $user = new User($email, $hash, $name, $surname, $accountType);
                $this->userRepository->addUser($user);

                $_SESSION['user'] = $user;
                $url = "http://$_SERVER[HTTP_HOST]";
                header("Location: {$url}");
            } catch (Exception $e) {
                $this->render('register', ['messages' => [$e->getMessage()]]);
            }
        } else {
            $this->render('register');
        }
    }

    public function logout()
    {
        session_destroy();

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}");
    }
}