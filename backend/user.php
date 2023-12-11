<?php

if (basename($_SERVER['PHP_SELF']) === basename(__FILE__)) {
    echo '<!DOCTYPE html>';
    echo '<html lang="en">';
    echo '<head>';
    echo '<meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>Get outa here</title>';
    echo '</head>';
    echo '<body>';
    echo '<h1>403 - Access forbidden</h1>';
    echo '</body>';
    echo '</html>';
    die();
};

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