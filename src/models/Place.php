<?php

class Place {
    private string $name;
    private string $description;
    private ?string $imagePath;
    private bool $animalsAllowed;

    private string $postalCode;
    private string $city;
    private string $number;
    private string $street;

    public function __construct($name,
                                $description,
                                $animalsAllowed,
                                $imagePath,
                                $postalCode,
                                $city,
                                $number,
                                $street)
    {
        $this->name = $name;
        $this->description = $description;
        $this->imagePath = $imagePath;
        $this->animalsAllowed = $animalsAllowed;

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

    public function getImagePath(): string
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
}