<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{
    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
        SELECT u.id, 
               u.email,
               u.password,
               u.name,
               u.surname,
               acct.type_name
        FROM users u
        LEFT JOIN account_types acct on acct.id = u.account_type_id
        WHERE email = :email
        ');

        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result == false)
            throw new Exception('Could not fetch users');

        return new User(
            $result['id'],
            $result['email'],
            $result['password'],
            $result['name'],
            $result['surname'],
            $result['type_name']
        );
    }

    public function addUser(User $user)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (name, surname, email, password, account_type_id) 
            VALUES (?, ?, ?, ?, ?)
        ');

        $result = $stmt->execute([
            $user->getName(),
            $user->getSurname(),
            $user->getEmail(),
            $user->getPassword(),
            $this->getAccountTypeId($user->getAccountType())
        ]);

        if ($result == false)
            throw new Exception('Could create user');
    }

    private function getAccountTypeId(string $type_name) : ?int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM account_types WHERE type_name = :type_name LIMIT 1
        ');
        $stmt->bindParam(':type_name', $type_name);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result == false)
            throw new Exception('Could get account type');

        return $result['id'];
    }
}