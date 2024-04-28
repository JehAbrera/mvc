<?php

require_once 'Database.php';

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
        return $this->viewList($update);
    }

    // Delete //
    public function deleteInfo($id)
    {
        $sql = "DELETE FROM reservations WHERE reservationId = ?";
        $stmt = $this->db_connect()->prepare($sql);
        $stmt->execute([$id]);
        return $this->viewList("Pending");
    }

    // Check Admin credentials //
    public function checkLogin($user, $hash) {
        $sql = "SELECT COUNT(*) FROM adminlogin WHERE username = ? AND password = ?";
        $stmt = $this->db_connect()->prepare($sql);
        $stmt->execute([$user, $hash]);

        if ($stmt->fetchColumn() > 0) {
            return true;
        } else {
            return false;
        }
    }
    // Query list of records //
    // Consider Read //
    public function viewList($page)
    {
        if (isset($_SESSION['view'])) {
            unset($_SESSION['view']);
        }
        $viewArray = [];

        // Query reservations
        $sql = "SELECT * FROM reservations WHERE status = ?";
        $stmt = $this->db_connect()->prepare($sql);

        // Add query parameter depending on status to query
        $_SESSION['page'] = $page;
        $stmt->execute([$page]);
        // Get row count from query
        if ($stmt->rowCount() < 1) {
            $_SESSION['nodata'] = "No reservations at $page status.";
            return header('Location: View/admin.php');
        }
        while ($row = $stmt->fetch()) {
            array_push($viewArray, [
                $row['reservationId'], $row['name'], $row['contact'], $row['date_reserved'], $row['time_reserved'],
                $row['reservation_from'], $row['reservation_to'], $row['room'], $row['capacity'], $row['payment'], $row['days'], $row['subtotal'],
                $row['discount'], $row['addtnl'], $row['total'], $row['status']
            ]);
        }
        $_SESSION['view'] = $viewArray;
        return header('Location: View/admin.php');
    }

    // Find specific name //
    public function findReserve($page, $name) {
        unset($_SESSION['view']);
        $viewArray = [];

        $sql = "SELECT * FROM reservations WHERE name LIKE ? and status = ?";
        $stmt = $this->db_connect()->prepare($sql);
        $stmt->execute(["%".strtolower($name)."%", $page]);

        if ($stmt->rowCount() < 1) {
            $_SESSION['nodata'] = "Name not found.";
            return header('Location: View/admin.php');
        }
        while ($row = $stmt->fetch()) {
            array_push($viewArray, [
                $row['reservationId'], $row['name'], $row['contact'], $row['date_reserved'], $row['time_reserved'],
                $row['reservation_from'], $row['reservation_to'], $row['room'], $row['capacity'], $row['payment'], $row['days'], $row['subtotal'],
                $row['discount'], $row['addtnl'], $row['total'], $row['status']
            ]);
        }
        $_SESSION['view'] = $viewArray;
        return header('Location: View/admin.php');
    }
}