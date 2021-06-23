<?php

class Place {
    private string $name;
    private string $description;
    private ?string $imagePath;
    private bool $animalsAllowed;

    public function __construct($name, $description, $animalsAllowed, $imagePath)
    {
        $this->name = $name;
        $this->description = $description;
        $this->imagePath = $imagePath;
        $this->animalsAllowed = $animalsAllowed;
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
}