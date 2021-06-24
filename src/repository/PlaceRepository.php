<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Place.php';

class PlaceRepository extends Repository
{
    public function getPlace(int $id): ?Place
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.places WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $place = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($place == false) {
            return null;
        }

        return new Place(
            $place['name'],
            $place['description'],
            $place['address']
        );
    }

    public function addPlace(Place $place): void
    {
        $pdo = $this->database->connect();

        $stmt = $pdo->prepare('
            INSERT INTO places (name, description, image_path, owner_id, animals_allowed, address_id)
            VALUES (?, ?, ?, ?, ?, ?)
        ');

        //TODO you should get this value from logged user session + transaction for address
        $assignedById = 5;

        $pdo->beginTransaction();

        try
        {
            $stmt->execute([
                $place->getName(),
                $place->getDescription(),
                $place->getImagePath(),
                $assignedById,
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
        // TODO: left join adress
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM places p
            JOIN addresses addrr on addrr.id = p.address_id
        ');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // TODO: add animal, start date end date
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