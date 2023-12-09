<?php

class User
{
    public int $id;
    public string $guid;
    public string $password;
    public string $pictureUrl;

    public function __construct($id, $guid, $password, $pictureUrl)
    {
        $this->id = $id;
        $this->guid = $guid;
        $this->password = $password;
        $this->pictureUrl = $pictureUrl;
    }

    public static function emptyUser(): User
    {
        return new self(-1, "", "", "");
    }
}