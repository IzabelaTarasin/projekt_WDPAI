<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Place.php';

class PlaceRepository extends Repository
{
    public function getPlace(int $id): ?Place
    {
        $stmt = $this->database->connect()->prepare('
            SELECT p.id, 
                   p.name, 
                   p.description, 
                   p.image_path,
                   p.owner_id,
                   p.animals_allowed,
                   
                   addrr.postal_code,
                   addrr.city,
                   addrr.number,
                   addrr.street
            FROM places p
            JOIN addresses addrr on addrr.id = p.address_id
            WHERE p.id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $place = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($place == false) {
            return null;
        }

        return new Place(
            $place['id'],
            $place['name'],
            $place['description'],
            $place['animals_allowed'],
            $place['owner_id'],
            $place['image_path'],
            $place['postal_code'],
            $place['city'],
            $place['number'],
            $place['street']);
    }

    public function addPlace(Place $place): void
    {
        $pdo = $this->database->connect();

        $stmt = $pdo->prepare('
            INSERT INTO places (name, description, image_path, owner_id, animals_allowed, address_id)
            VALUES (?, ?, ?, ?, ?, ?)
        ');

        $pdo->beginTransaction();

        try
        {
            $stmt->execute([
                $place->getName(),
                $place->getDescription(),
                $place->getImagePath(),
                $place->getOwnerId(),
                $place->isAnimalsAllowed() ? 1 : 0,
                $this->createAddress($place->getPostalCode(),
                    $place->getCity(),
                    $place->getNumber(),
                    $place->getStreet())
            ]);

            $pdo->commit();
        }
        catch (Exception $e)
        {
            $pdo->rollBack();
        }
    }

    private function createAddress($postalCode, $city, $number, $street) :int {
        $pdo = $this->database->connect();
        $stmt = $pdo->prepare('
            INSERT INTO addresses (postal_code, city, number, street) 
            VALUES (?, ?, ?, ?)
        ');

        $result = $stmt->execute([
            $postalCode,
            $city,
            $number,
            $street
        ]);

        if(!$result) {
            throw new Exception("Error");
        }

        return intval($pdo->lastInsertId());
    }

    public function getPlaces(): array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT p.id, 
                   p.name, 
                   p.description, 
                   p.image_path,
                   p.owner_id,
                   p.animals_allowed,
                   
                   addrr.postal_code,
                   addrr.city,
                   addrr.number,
                   addrr.street
            FROM places p
            JOIN addresses addrr on addrr.id = p.address_id
        ');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchPlaces(string $name, bool $animalsAllowed) : array {
        $name = '%' . strtolower($name) . '%';

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM places p
            JOIN addresses addrr on addrr.id = p.address_id
            WHERE LOWER(name) 
                      LIKE :name AND animals_allowed = :animalsAllowed;
        ');

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':animalsAllowed', $animalsAllowed, PDO::PARAM_BOOL);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}