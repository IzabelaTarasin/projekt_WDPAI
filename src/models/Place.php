<?php

class Place {
    private ?int $id;
    private string $name;
    private string $description;
    private ?string $imagePath;
    private bool $animalsAllowed;
    private ?int $ownerId;

    private string $postalCode;
    private string $city;
    private string $number;
    private string $street;

    public function __construct($id,
                                $name,
                                $description,
                                $animalsAllowed,
                                $ownerId,
                                $imagePath,
                                $postalCode,
                                $city,
                                $number,
                                $street)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->imagePath = $imagePath;
        $this->animalsAllowed = $animalsAllowed;
        $this->ownerId = $ownerId;

        $this->postalCode = $postalCode;
        $this->city = $city;
        $this->number = $number;
        $this->street = $street;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function isAnimalsAllowed(): bool
    {
        return $this->animalsAllowed;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getId(): ?int{
        return $this->id;
    }

    public function getOwnerId(): int
    {
        return $this->ownerId;
    }
}