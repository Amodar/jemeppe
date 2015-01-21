<?php
global $mysqli;

class Price {
    private $tax;
    private $administration_cost;
    private $additional_cost;
    
    function __construct($mysqli) {
        if($stmt = $mysqli->prepare("SELECT `tax`, `administration_cost`, `additional_costs` FROM `fixed_costs`")) {

            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            $stmt->bind_result($tax, $administration_cost, $additional_cost);
            $stmt->fetch();

            $this->tax = $tax;
            $this->administration_cost = $administration_cost;
            $this->additional_cost = $additional_cost;
        }
    }
    
    public function getTax() {
        return $this->tax;
    }

    public function getAdministration_cost() {
        return $this->administration_cost;
    }

    public function getAdditional_cost() {
        return $this->additional_cost;
    }
    
    public function setTax($tax) {
        $this->tax = $tax;
    }

    public function setAdministration_cost($administration_cost) {
        $this->administration_cost = $administration_cost;
    }

    public function setAdditional_cost($additional_cost) {
        $this->additional_cost = $additional_cost;
    }
}
