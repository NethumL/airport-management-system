<?php

require_once __DIR__ . '/AbstractManager.php';

class SeatManager extends AbstractManager
{
    public static function addSeat($xPosition, $yPosition, $flightNumber, $class): bool
    {
        $stmt = self::$db->prepare("INSERT INTO seat(xPosition, yPosition, isBooked, flightNumber, class) VALUES(?, ?, ?, ?, ?);");
        return $stmt->execute([$xPosition, $yPosition, 0, $flightNumber, $class]);
    }

    public static function editSeat($id, $xPosition, $yPosition, $class): bool
    {
        $query = "UPDATE seat SET xPosition = ?, yPosition = ?, class = ?";
        $params = [$xPosition, $yPosition, $class, $id];
        $query .= " WHERE id = ?;";
        $stmt = self::$db->prepare($query);
        return $stmt->execute($params);
    }

    public static function updateBookingStatus($id, $isBooked): bool
    {
        $stmt = self::$db->prepare("UPDATE seat SET isBooked = ? WHERE id = ?;");
        return $stmt->execute([$isBooked, $id]);
    }

    public static function removeSeat($id): bool
    {
        $stmt = self::$db->prepare("DELETE FROM seat WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function getSeat($id): array|false
    {
        $stmt = self::$db->prepare("SELECT * FROM seat WHERE id=?;");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        if ($result) {
            return [
                'id' => $result['id'],
                'xPosition' => $result['xPosition'],
                'yPosition' => $result['yPosition'],
                'isBooked' => $result["isBooked"],
                'flightNumber' => $result['flightNumber'],
                'class' => $result['class']
            ];
        } else {
            return false;
        }
    }

    public static function getSeatsBy($flightNumber, $class = ''): array|false
    {
        $query = "SELECT * FROM seat WHERE flightNumber = ? ";
        $params = [$flightNumber];
        if (!empty($class)) {
            $query .= "AND class = ?";
            $params[] = $class;
        }
        $query .= " ORDER BY yPosition, xPosition;";
        $stmt = self::$db->prepare($query);
        $stmt->execute($params);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (gettype($result) === "array") {
            $output = array();
            foreach ($result as $row) {
                $output[] = [
                    "id" => $row["id"],
                    "xPosition" => $row["xPosition"],
                    "yPosition" => $row["yPosition"],
                    "isBooked" => $row["isBooked"],
                    "flightNumber" => $row["flightNumber"],
                    "class" => $row["class"],
                ];
            }
            return $output;
        } else {
            return false;
        }
    }
}
