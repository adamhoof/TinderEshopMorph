<?php
class User
{
    public int $id;

    public string $guid;
    public string $password;

    public function __construct($id, $guid, $password)
    {
        $this->id = $id;
        $this->guid = $guid;
        $this->password = $password;
    }

    public static function emptyUser(): User
    {
        return new self(-1, "", "");
    }
}