<?php

include 'Database.php';

Class Model extends Database {
    // Create //
    public function addReservation($name, $phone, $date, $time, $from, $to, $room, $cap, $payment, $days, $sub, $disc, $add, $total, $status)
    {
        $sql = "INSERT INTO reservations VALUES ('', ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->db_connect()->prepare($sql);
        $stmt->execute([$name, $phone, $date, $time, $from, $to, $room, $cap, $payment, $days, $sub, $disc, $add, $total, $status]);
        return header('Location: View/success.html');
    }
    // Update //
    public function updateStatus($update, $id)
    {
        $sql = "UPDATE reservations SET status = ? WHERE reservationId = ?";
        $stmt = $this->db_connect()->prepare($sql);
        $stmt->execute([$update, $id]);
    }

    // Delete //
    public function deleteInfo($id)
    {
        $sql = "DELETE FROM reservations WHERE reservationId = ?";
        $stmt = $this->db_connect()->prepare($sql);
        $stmt->execute([$id]);
    }
}