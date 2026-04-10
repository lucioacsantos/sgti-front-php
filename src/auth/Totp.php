<?php
require_once __DIR__ . '/../lib/GoogleAuthenticator.php';

class Totp {

    private $ga;

    public function __construct() {
        $this->ga = new PHPGangsta_GoogleAuthenticator();
    }

    public function createSecret() {
        return $this->ga->createSecret();
    }

    public function getQR($user, $secret) {
        return $this->ga->getQRCodeGoogleUrl($user, $secret, 'CMDB');
    }

    public function verify($secret, $code) {
        return $this->ga->verifyCode($secret, $code, 2);
    }
}