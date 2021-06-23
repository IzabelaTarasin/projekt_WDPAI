<?php

require_once 'AccountType.php';

class User {
    private $email;
    private $password;
    private $name;
    private $surname;
    private $accountType;

    public function __construct(
        string $email,
        string $password,
        string $name,
        string $surname,
        $accountType
    ) {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->accountType = $accountType;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getAccountType(): string
    {
        return $this->accountType;
    }
}