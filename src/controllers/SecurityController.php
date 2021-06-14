<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController
{
    public function login()
    {
        $userRepository = new UserRepository();

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];

        $user = $userRepository->getUser($email);

        if(!$user){
            return $this->render('login', ['messages' => ['User not exist']]);
        }

        if($user->getEmail() !== $email){
            return $this->render('login', ['messages' => ['User does not exists']]);
        }

        if($user->getPassword() !== $password){
            return $this->render('login', ['messages' => ['Wrong password']]);
        }

//        return $this->render('places');

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/places");
    }
}