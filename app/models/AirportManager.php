<?php

require_once __DIR__ . '/AbstractManager.php';

class AirportManager extends AbstractManager
{
    public static function registerAirport($name): bool
    {
        $stmt = self::$db->prepare("INSERT INTO airport(name) VALUES(?);");
        return $stmt->execute([$name]);
    }

    public static function updateAirport($id, $name): bool
    {
        $query = "UPDATE airport SET name = ?";
        $params = [$name, $id];
        $query .= " WHERE id = ?;";
        $stmt = self::$db->prepare($query);
        return $stmt->execute($params);
    }

    public static function removeAirport($id): bool
    {
        $stmt = self::$db->prepare("DELETE FROM airport WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function getAirport($id): array|false
    {
        $stmt = self::$db->prepare("SELECT * FROM airport WHERE id=?;");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        if ($result) {
            return [
                'id' => $result['id'],
                'name' => $result['name'],
            ];
        } else {
            return false;
        }
    }

    public static function getAllAirports(): array|false
    {
        $stmt = self::$db->prepare("SELECT id FROM airport;");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (gettype($result) === "array") {
            $airports = array();
            foreach ($result as $row) {
                $airport = self::getAirport($row['id']);
                $airports[] = $airport;
            }
            return $airports;
        } else {
            return false;
        }
    }

    public static function getAirportsBy($name): array|false
    {
        $query = "SELECT * FROM airport WHERE name LIKE ?;";
        $params = ['%' . $name . '%'];
        $stmt = self::$db->prepare($query);
        $stmt->execute($params);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (gettype($result) === "array") {
            $output = array();
            foreach ($result as $row) {
                $output[] = [
                    "id" => $row["id"],
                    "name" => $row["name"]
                ];
            }
            return $output;
        } else {
            return false;
        }
    }
}
