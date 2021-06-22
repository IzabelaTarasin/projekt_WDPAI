<?php

require_once 'Repository.php';

class AccountTypeRepository extends Repository
{
    public function getBusinessType(): ?AccountType
    {
        return $this->getByName('business');
    }

    public function getStandardType(): ?AccountType
    {
        return $this->getByName('standard');
    }

    public function getById(int $id): ?AccountType
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM account_types WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result == false) {
            return null;
        }

        return new AccountType(
            $result['id'],
            $result['name']
        );
    }

    private function getByName(string $name): ?AccountType
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM account_types WHERE name = :name
        ');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result == false) {
            return null;
        }

        return new AccountType(
            $result['id'],
            $result['name']
        );
    }
}