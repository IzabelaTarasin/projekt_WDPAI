<?php

class Booking
{
    private int $userId;
    private int $placeId;
    private DateTime $startDate;
    private DateTime $endDate;
    private bool $hasAnimals;

    public function __construct(
        int $userId,
        int $placeId,
        DateTime $startDate,
        DateTime $endDate,
        bool $hasAnimals)
    {
        $this->userId = $userId;
        $this->placeId = $placeId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->hasAnimals = $hasAnimals;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getPlaceId(): int
    {
        return $this->placeId;
    }

    public function getStartDate(): DateTime
    {
        return $this->startDate;
    }

    public function getEndDate(): DateTime
    {
        return $this->endDate;
    }

    public function isHasAnimals(): bool
    {
        return $this->hasAnimals;
    }
}