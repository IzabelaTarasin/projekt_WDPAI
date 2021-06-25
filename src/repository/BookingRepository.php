<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Booking.php';

class BookingRepository extends Repository
{
    public function addBooking(Booking $booking)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO bookings (user_id, place_id, start_date, end_date, has_animals) 
            VALUES (?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $booking->getUserId(),
            $booking->getPlaceID(),
            $booking->getStartDate()->format('Y-m-d'),
            $booking->getEndDate()->format('Y-m-d'),
            $booking->isHasAnimals() ? 1 : 0
        ]);
    }

    public function checkIsAvailable(DateTime $start, DateTime $end, int $placeId) : bool {
        $stmt = $this->database->connect()->prepare('
        SELECT COUNT(*) as total
        FROM bookings
        WHERE start_date <= :end AND :start <= end_date AND place_id = :placeId;
        ');

        $startDateStr = $start->format('Y-m-d');
        $endDateStr = $end->format('Y-m-d');

        $stmt->bindParam(':start', $startDateStr);
        $stmt->bindParam(':end', $endDateStr);
        $stmt->bindParam(':placeId', $placeId);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result == false) {
            throw new Exception('Error');
        }

        return $result['total'] == 0;
    }
}