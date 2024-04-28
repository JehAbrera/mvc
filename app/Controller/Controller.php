<?php
session_start();

require_once 'Model/Model.php';

class Controller extends Model {

    private $days, $dayRate, $addChar, $subTot, $discRate, $discTot, $addTot, $total;
    
    function dateAuth($from, $to) : bool {
        $start = new \DateTime($from);
        $end = new \DateTime($to);
        if ($start >= $end) {
            return false;
        }
        return true;
    }
    function phoneAuth($phone) : bool {
        $justNums = preg_replace("/[^0-9]/", '', $phone);

        if (!preg_match("/^09[0-9]{9}$/", $justNums)) {
            return false;
        }
        return true;
    }
    public function loginAuth($username, $pass) {
        $hash = hash('sha256', $pass);
        if ($this->checkLogin($username,$hash)) {
            $_SESSION['isLogged'] = true;
            return $this->viewList("Pending");
        } else {
            $_SESSION['loginErr'] = "Invalid login username or password!";
            return header('Location: View/login.php');
        }
    }

    public function computeTotal($name, $phone, $from, $to, $room, $cap, $payment, $datetime)
    {
        if (!$this->phoneAuth($phone)) {
            $_SESSION['error'] = "Invalid phone number";
            return header("Location: View/form.php");
        }
        if (!$this->dateAuth($from, $to)) {
            $_SESSION['error'] = "Invalid date selection";
            return header("Location: View/form.php");
        }
        $arr = explode("-", $datetime);

        $this->setDays($from, $to);
        $this->setRate($room, $cap);
        $this->setAddChar($payment);
        $this->setSub();
        $this->setDiscTot();
        $this->setAddTot();
        $this->setTotal();

        $data = [
            'name' => $name,
            'phone' => $phone,
            'from' => $from,
            'to' => $to,
            'room' => $room,
            'cap' => $cap,
            'payment' => $payment,
            'date' => $arr[0],
            'time' => $arr[1],
            'days' => $this->days,
            'sub' => $this->subTot,
            'add' => $this->addTot,
            'disc' => $this->discTot,
            'total' => $this->total,
        ];

        $_SESSION['data'] = $data;
        return header('Location: View/form.php?step=overview');

    }
    protected function setDays($from, $to)
    {
        $start = new \DateTime($from);
        $end = new \DateTime($to);
        $this->days = ($start->diff($end))->days;
    }
    protected function setRate($room, $cap)
    {
        switch ($cap) {
            case 'Single':
                switch ($room) {
                    case 'Suite':
                        $this->dayRate = 100.00;
                        break;
                    case 'Deluxe':
                        $this->dayRate = 300.00;
                        break;
                    case 'Luxury':
                        $this->dayRate = 500.00;
                        break;
                }
                break;
            case 'Double':
                switch ($room) {
                    case 'Suite':
                        $this->dayRate = 200.00;
                        break;
                    case 'Deluxe':
                        $this->dayRate = 500.00;
                        break;
                    case 'Luxury':
                        $this->dayRate = 800.00;
                        break;
                }
                break;
            case 'Family':
                switch ($room) {
                    case 'Suite':
                        $this->dayRate = 500.00;
                        break;
                    case 'Deluxe':
                        $this->dayRate = 750.00;
                        break;
                    case 'Luxury':
                        $this->dayRate = 1000.00;
                        break;
                }
                break;
        }
    }
    protected function setAddChar($payment)
    {
        switch ($payment) {
            case 'Cash':
                $this->addChar = 0;
                if ($this->days >= 3 && $this->days <= 5) {
                    $this->setDiscRate(0.10);
                } elseif ($this->days >= 6) {
                    $this->setDiscRate(0.15);
                } else {
                    $this->setDiscRate(0);
                }
                break;
            case 'Cheque':
                $this->addChar = 0.05;
                break;
            case 'Credit Card':
                $this->addChar = 0.1;
                break;
        }
    }
    protected function setSub()
    {
        $this->subTot = $this->dayRate * $this->days;
    }
    protected function setDiscRate($val)
    {
        $this->discRate = $val;
    }
    protected function setDiscTot()
    {
        $this->discTot = $this->subTot * $this->discRate;
    }
    protected function setAddTot()
    {
        $this->addTot = $this->subTot * $this->addChar;
    }
    protected function setTotal()
    {
        $this->total = $this->subTot + $this->addTot - $this->discTot;
    }  
}