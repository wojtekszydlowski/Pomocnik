<?php
class Calculator
{
    private $operations;

    /**
     * Calculator constructor.
     */
    public function __construct()
    {
        $this->operations = [];
        // $this->operations = array();
    }

    protected function log($operation, $num1, $num2, $result)
    {
        switch ($operation) {
            case 'added': $conjunction = 'to'; break;
            case 'multiplied':
            case 'divided':
                $conjunction = 'by';
                break;
            case 'subtracted': $conjunction = 'from'; break;
            case 'pow': $conjunction = ' ^ '; break;
            case 'root': $conjunction = ' root '; break;
        }

        $this->operations[] = $operation . ' ' . $num1 . ' ' . $conjunction . ' ' . $num2 . ' gives ' . $result;
    }

    public function add($num1, $num2)
    {
        $result = $num1 + $num2;

        $this->log('added', $num1, $num2, $result);

        return $result;
    }

    public function multiply($num1, $num2)
    {
        if (is_numeric($num1) && is_numeric($num2)) {
            if ($num2 != 0) {
                $result = $num1 * $num2;

                $this->log('multiplied', $num1, $num2, $result);

                return $result;
            } else {
                //
            }
        }
    }

    public function subtract($num1, $num2)
    {
        $result = $num1 - $num2;

        $this->log('subtracted', $num1, $num2, $result);

        return $result;
    }

    public function divide($num1, $num2)
    {
        if ($num2 != 0) {
            $result = $num1 / $num2;


            $this->log('subtracted', $num1, $num2, $result);

            return $result;
        }
        else {
            //
        }

    }

    public function printOperations()
    {
        foreach ($this->operations as $operation) {
            //echo $operation . PHP_EOL; - przejście do nowej linii w php
            echo $operation . "<br>";
        }
    }

    public function clearOperations()
    {
        $this->operations = [];
    }
}