<?php

require_once __DIR__ . '/AbstractManager.php';

class BookingManager extends AbstractManager
{
    public static function bookFlight($flightNumber, $isPaid, $email, $seats): bool
    {
        $stmt = self::$db->prepare("INSERT INTO booking(flightNumber, isPaid, email) VALUES(?, ?, ?);");
        $success = $stmt->execute([$flightNumber, $isPaid, $email]);
        if ($success) {
            $stmt = self::$db->prepare("SELECT @@IDENTITY");
            $stmt->execute();
            $bookingId = $stmt->fetch();
            return self::bookSeats($seats, $bookingId[0]);
        } else {
            return $success;
        }
    }

    private static function bookSeats($seats, $bookingId): bool
    {
        foreach ($seats as $seat) {
            $stmt = self::$db->prepare("INSERT INTO booking_seat(bookingId, seatId) VALUES(?, ?);");
            $result = $stmt->execute([$bookingId, $seat]);
            if (!$result) {
                return $result;
            }
        }
        return $result;
    }

    public static function cancelBooking($id): bool
    {
        $stmt = self::$db->prepare("DELETE FROM booking WHERE id = ?");
        return $stmt->execute([$id]) and self::removeSeats($id);
    }
    private static function removeSeats($bookingId): bool
    {
        $stmt = self::$db->prepare("DELETE FROM booking_seat WHERE bookingId = ?");
        return $stmt->execute([$bookingId]);
    }
    public static function editBooking($id, $flightNumber, $isPaid, $seats): bool
    {
        $query = "UPDATE booking SET flightNumber = ?, isPaid = ?";
        $params = [$flightNumber, $isPaid, $id];
        $query .= " WHERE id = ?;";
        $stmt = self::$db->prepare($query);
        $success = $stmt->execute($params);
        if ($success) {
            return self::removeSeats($id) and self::bookSeats($seats, $id);
        }
    }

    public static function updatePaidStatus($id, $isPaid): bool
    {
        $stmt = self::$db->prepare("UPDATE booking SET isPaid = ? WHERE id = ?;");
        return $stmt->execute([$isPaid, $id]);
    }

    public static function getBooking($id): array|false
    {
        $stmt = self::$db->prepare("SELECT * FROM booking WHERE id=?;");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        $stmt = self::$db->prepare("SELECT seatId FROM booking_seat WHERE bookingId=?;");
        $stmt->execute([$id]);
        $result_ = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result and $result_) {
            $seatArr = array();
            foreach ($result_ as $row) {
                $seatArr[] = $row['seatId'];
            }
            return [
                'id' => $result['id'],
                'flightNumber' => $result['flightNumber'],
                'isPaid' => $result['isPaid'],
                'email' => $result["email"],
                'seats' => $seatArr
            ];
        } else {
            return false;
        }
    }

    public static function getBookingBy($email = '', $isPaid = '', $flightNumber = ''): array|false
    {
        $query = "SELECT * FROM booking WHERE ";
        $params = [];
        if (!empty($email)) {
            $query .= "email = ? AND ";
            $params[] = $email;
        }
        if ($isPaid != '') {
            $query .= "(isPaid = ?) AND ";
            $params[] = $isPaid;
        }
        if (!empty($flightNumber)) {
            $query .= "flightNumber = ? AND ";
            $params[] = $flightNumber;
        }
        $query .= "1;";
        $stmt = self::$db->prepare($query);
        $stmt->execute($params);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (gettype($result) === "array") {
            $output = array();
            foreach ($result as $row) {
                $stmt = self::$db->prepare("SELECT seatId FROM booking_seat WHERE bookingId=?;");
                $stmt->execute([$row['id']]);
                $result_ = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $seatArr = array();
                foreach ($result_ as $r) {
                    $seatArr[] = $r['seatId'];
                }
                $output[] = [
                    "id" => $row["id"],
                    "flightNumber" => $row["flightNumber"],
                    "isPaid" => $row["isPaid"],
                    "email" => $row["email"],
                    "seats" => $seatArr,
                ];
            }
            return $output;
        } else {
            return false;
        }
    }
}
