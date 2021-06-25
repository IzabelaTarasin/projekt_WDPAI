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
        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];

        $user = $this->userRepository->getUser($email);

        if(!$user){
            return $this->render('login', ['messages' => ['User not exist']]);
        }

        if($user->getEmail() !== $email){
            return $this->render('login', ['messages' => ['User does not exists']]);
        }

        if(!password_verify($password, $user->getPassword())){
            return $this->render('login', ['messages' => ['Wrong password']]);
        }

        $_SESSION['user'] = $user;

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/places");
    }

    public function register()
    {
        if (!$this->isPost()) {
            return $this->render('register');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirmedPassword'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $accountType = $_POST['accountType'];

        //TODO: empty field validation

        if ($password !== $confirmedPassword) {
            return $this->render('register', ['messages' => ['Passwords do not match']]);
        }

        $existingUser = $this->userRepository->getUser($email);

        if($existingUser != null)
        {
            return $this->render('register', ['messages' => ['You already have an account']]);
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $user = new User($email, $hash, $name, $surname, $accountType);
        $this->userRepository->addUser($user);

        return $this->render('login', ['messages' => ['You\'ve been succesfully registrated!']]);
    }

    public function logout()
    {
        session_destroy();

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}");
    }
}