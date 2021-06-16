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
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO places (name, description, address, id_assigned_by)
            VALUES (?, ?, ?, ?)
        ');

        //TODO you should get this value from logged user session
        $assignedById = 1;

        $stmt->execute([
            $place->getName(),
            $place->getDescription(),
            $place->getAddress(),
//            $date->format('Y-m-d'),
            $assignedById
        ]);
    }

    public function getPlaces(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM places;
        ');
        $stmt->execute();
        $places = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($places as $place) {
            $result[] = new Project(
                $place['name'],
                $place['description'],
                $place['address']
            );
        }

        return $result;
    }
}