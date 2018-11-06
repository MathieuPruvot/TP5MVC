
<?php

class Client {

    public $user_id = null;
    public $user_nom = null;
    public $user_prenom = null;
    public $user_age = null;
    public $user_date = null;

    public function __construct($user_nom, $user_prenom, $user_age, $user_date) {

        $this->user_nom = $user_nom;
        $this->user_prenom = $user_prenom;
        $this->user_age = $user_age;
        $this->user_date = $user_date;
    }

    public function setId($user_id) {
        $this->user_id = $user_id;
    }

    public function get_user_id() {
        return $this->user_id;
    }

    public function get_user_nom() {
        return $this->user_nom;
    }

    public function get_user_prenom() {
        return $this->user_prenom;
    }

    public function get_user_age() {
        return $this->user_age;
    }

    public function get_user_date() {
        return $this->user_date;
    }
}

?>