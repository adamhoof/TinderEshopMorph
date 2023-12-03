<?php

class User {
    public string $guid;
    public string $password;
    public string $pictureUrl;

    public function __construct($guid, $password, $pictureUrl) {
        $this->guid = $guid;
        $this->password = $password;
        $this->pictureUrl = $pictureUrl;
    }

    public static function emptyUser(): User
    {
        return new self("","","");
    }
}