<?php

require_once __DIR__ . '/AbstractManager.php';

class FlightManager extends AbstractManager
{
    public static function addFlight($airline, $begin, $end, $departureDateTime, $arrivalDateTime, $economyClassPrice, $businessClassPrice, $status, $planeWidth, $planeLength): bool
    {
        try {
            self::$db->beginTransaction();
            $stmt = self::$db->prepare("INSERT INTO flight(airline, begin, end, departureDateTime, arrivalDateTime, economyClassPrice, businessClassPrice, status) VALUES(?, ?, ?, ?, ?, ?, ?, ?);");
            $stmt->execute([$airline, $begin, $end, $departureDateTime, $arrivalDateTime, $economyClassPrice, $businessClassPrice, $status]);
            $flightId = self::$db->lastInsertId();

            $stmt = self::$db->prepare("INSERT INTO seat(xPosition, yPosition, isBooked, flightNumber, class) VALUES(?, ?, ?, ?, ?);");
            for ($x = 65; $x <= 64 + $planeWidth; $x++) {
                for ($y = 1; $y <= $planeLength; $y++) {
                    $stmt->execute([chr($x), $y, 0, $flightId, $y <= $planeLength / 2 ? "ECONOMY" : "BUSINESS"]);
                }
            }
            return self::$db->commit();
        } catch (Exception $e) {
            self::$db->rollBack();
            throw $e;
        }
    }

    public static function editFlight($id, $airline, $begin, $end, $departureDateTime, $arrivalDateTime, $economyClassPrice, $businessClassPrice, $status): bool
    {
        $query = "UPDATE flight SET airline = ?, begin = ?, end = ?, departureDateTime = ?, arrivalDateTime = ?, economyClassPrice = ?, businessClassPrice = ?, status = ?";
        $params = [$airline, $begin, $end, $departureDateTime, $arrivalDateTime, $economyClassPrice, $businessClassPrice, $status, $id];
        $query .= " WHERE id = ?;";
        $stmt = self::$db->prepare($query);
        return $stmt->execute($params);
    }

    public static function deleteFlight($id): bool
    {
        $stmt = self::$db->prepare("DELETE FROM flight WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function updateStatus($id, $status): bool
    {
        $stmt = self::$db->prepare("UPDATE flight SET status = ? WHERE id = ?;");
        return $stmt->execute([$status, $id]);
    }

    public static function getAllFlights(): array|false
    {
        $stmt = self::$db->prepare("SELECT id FROM flight;");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (gettype($result) === "array") {
            $flights = array();
            foreach ($result as $row) {
                $flight = self::getFlight($row['id']);
                $flights[] = $flight;
            }
            return $flights;
        } else {
            return false;
        }
    }

    public static function getFlight($id): array|false
    {
        $stmt = self::$db->prepare(
            "SELECT flight.*, b.name AS beginName, e.name AS endName FROM flight
            JOIN airport b ON flight.begin = b.id
            JOIN airport e ON flight.end = e.id
            WHERE flight.id=?;"
        );
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        if ($result) {
            return [
                'id' => $result['id'],
                'airline' => $result['airline'],
                'begin' => $result['begin'],
                'beginName' => $result['beginName'],
                'end' => $result['end'],
                'endName' => $result['endName'],
                'departureDateTime' => $result['departureDateTime'],
                'arrivalDateTime' => $result['arrivalDateTime'],
                'economyClassPrice' => $result['economyClassPrice'],
                'businessClassPrice' => $result['businessClassPrice'],
                'status' => $result['status']
            ];
        } else {
            return false;
        }
    }

    public static function getFlightsBy($begin = '', $end = '', $departingAfter = '', $departingBefore = '', $economyClassPrice = '', $businessClassPrice = '', $status = ''): array|false
    {
        $query = "SELECT flight.*, b.name AS beginName, e.name as endName FROM flight JOIN airport b ON b.id = flight.begin JOIN airport e ON e.id = flight.end WHERE ";
        $params = [];
        if (!empty($begin)) {
            $query .= "b.name = ? AND ";
            $params[] = $begin;
        }
        if (!empty($end)) {
            $query .= "e.name = ? AND ";
            $params[] = $end;
        }
        if (!empty($departingAfter)) {
            $afterTime = $departingAfter . " 00:00:00";
            $query .= "departureDateTime >= ? AND ";
            $params[] = $afterTime;
        }
        if (!empty($departingBefore)) {
            $beforeTime = $departingBefore . " 23:59:59";
            $query .= "departureDateTime <= ? AND ";
            $params[] = $beforeTime;
        }
        if (!empty($economyClassPrice)) {
            $query .= "economyClassPrice = ? AND ";
            $params[] = $economyClassPrice;
        }
        if (!empty($businessClassPrice)) {
            $query .= "businessClassPrice = ? AND ";
            $params[] = $businessClassPrice;
        }
        if (!empty($status)) {
            $query .= "status = ? AND ";
            $params[] = $status;
        }
        $query .= "1;";
        $stmt = self::$db->prepare($query);
        $stmt->execute($params);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (gettype($result) === "array") {
            $output = array();
            foreach ($result as $row) {
                $output[] = [
                    "id" => $row["id"],
                    "airline" => $row["airline"],
                    "begin" => $row["begin"],
                    "beginName" => $row["beginName"],
                    "end" => $row["end"],
                    "endName" => $row["endName"],
                    "departureDateTime" => $row["departureDateTime"],
                    "arrivalDateTime" => $row["arrivalDateTime"],
                    "economyClassPrice" => $row["economyClassPrice"],
                    "businessClassPrice" => $row["businessClassPrice"],
                    "status" => $row["status"],
                ];
            }
            return $output;
        } else {
            return false;
        }
    }
}
