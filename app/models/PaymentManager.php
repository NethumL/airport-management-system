<?php

require_once __DIR__ . '/AbstractManager.php';

class PaymentManager extends AbstractManager
{
    public static function addPayment($creditCardNumber, $paidAmount, $email, $bookingId): bool
    {
        $stmt = self::$db->prepare("INSERT INTO payment(creditCardNumber, paidAmount, email, bookingId) VALUES(?, ?, ?, ?);");
        return $stmt->execute([$creditCardNumber, $paidAmount, $email, $bookingId]);
    }

    public static function getPayment($id): array|false
    {
        $stmt = self::$db->prepare("SELECT * FROM payment WHERE id=?;");
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        if ($result) {
            return [
                'id' => $result['id'],
                'creditCardNumber' => $result['creditCardNumber'],
                'paidAmount' => $result['paidAmount'],
                'paidDateTime' => $result["paidDateTime"],
                'email' => $result['email'],
                'bookingId' => $result['bookingId']
            ];
        } else {
            return false;
        }
    }

    public static function getPaymentsBy($bookingId = '', $email = '', $paidDate = ''): array|false
    {
        $query = "SELECT * FROM payment WHERE ";
        $params = [];
        if (!empty($bookingId)) {
            $query .= "bookingId = ? AND ";
            $params[] = $bookingId;
        }
        if (!empty($email)) {
            $query .= "email = ? AND ";
            $params[] = $email;
        }
        if (!empty($paidDate)) {
            $startTime = $paidDate . " 00:00:00";
            $endTime = $paidDate . " 23:59:59";
            $query .= "(paidDateTime BETWEEN ? AND ?) AND ";
            $params[] = $startTime;
            $params[] = $endTime;
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
                    "creditCardNumber" => $row["creditCardNumber"],
                    "paidAmount" => $row["paidAmount"],
                    "paidDateTime" => $row["paidDateTime"],
                    "email" => $row["email"],
                    "bookingId" => $row["bookingId"]
                ];
            }
            return $output;
        } else {
            return false;
        }
    }
}
