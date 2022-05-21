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
        $stmt = self::$db->prepare("SELECT * FROM flight WHERE id=?;");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        if ($result) {
            return [
                'id' => $result['id'],
                'airline' => $result['airline'],
                'begin' => $result['begin'],
                'end' => $result["end"],
                'departureDateTime' => $result['departureDateTime'],
                'arrivaDateTime' => $result['arrivalDateTime'],
                'economyClassPrice' => $result['economyClassPrice'],
                'businessClassPrice' => $result["businessClassPrice"],
                'status' => $result["status"]
            ];
        } else {
            return false;
        }
    }

    public static function getFlightsBy($begin = '', $end = '', $departureDate = '', $arrivalDate = '', $economyClassPrice = '', $businessClassPrice = '', $status = ''): array|false
    {
        $query = "SELECT * FROM flight WHERE ";
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
                    "airline" => $row["begin"],
                    "end" => $row["end"],
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
