<?php

require_once __DIR__ . '/AbstractManager.php';

class FlightManager extends AbstractManager
{
    public static function addFlight($airline, $begin, $end, $departureDateTime, $arrivalDateTime, $economyClassPrice, $businessClassPrice, $status): bool
    {
        $stmt = self::$db->prepare("INSERT INTO flight(airline, begin, end, departureDateTime, arrivalDateTime, economyClassPrice, businessClassPrice, status) VALUES(?, ?, ?, ?, ?, ?, ?, ?);");
        return $stmt->execute([$airline, $begin, $end, $departureDateTime, $arrivalDateTime, $economyClassPrice, $businessClassPrice, $status]);
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

    public static function getFlightsBy($begin = '', $end = '', $departureDate = '', $arrivalDate = '', $economyClassPrice = '', $businessClassPrice = '', $status = ''): array|false
    {
        $query = "SELECT flight.*, b.name AS beginName, e.name as endName FROM flight JOIN airport b ON b.id = flight.begin JOIN airport e ON e.id = flight.end WHERE ";
        $params = [];
        if (!empty($begin)) {
            $query .= "begin = ? AND ";
            $params[] = $begin;
        }
        if (!empty($end)) {
            $query .= "end = ? AND ";
            $params[] = $end;
        }
        if (!empty($departureDate)) {
            $startTime = $departureDate . " 00:00:00";
            $endTime = $departureDate . " 23:59:59";
            $query .= "(departureDateTime BETWEEN ? AND ?) AND ";
            $params[] = $startTime;
            $params[] = $endTime;
        }
        if (!empty($arrivalDate)) {
            $startTime = $arrivalDate . " 00:00:00";
            $endTime = $arrivalDate . " 23:59:59";
            $query .= "(arrivalDateTime BETWEEN ? AND ?) AND ";
            $params[] = $startTime;
            $params[] = $endTime;
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
