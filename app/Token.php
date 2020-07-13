<?php

    namespace App;

use DateTime;

class Token {

    private $accessToken;
    private $expiringTimestamp;

    public function __construct($accessToken,$expiringSeconds) {
        $this->accessToken = $accessToken;
        $this->expiringTimestamp = (int)(time() + $expiringSeconds);
    }

    public function __get($prop) {
        return $this->$prop;
    }
}