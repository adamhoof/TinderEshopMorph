<?php

/**
 * Represents a user in the system.
 *
 * This class models a user, including their ID, GUID, and password.
 */
class User
{
    /**
     * The unique identifier of the user.
     */
    public int $id;

    /**
     * The Global Unique Identifier GUID of the user.
     */
    public string $guid;

    /**
     * The password of the user.
     */
    public string $password;

    /**
     * Constructor for the User class.
     *
     * @param int $id The ID of the user.
     * @param string $guid The GUID of the user.
     * @param string $password The password of the user.
     */
    public function __construct(int $id, string $guid, string $password)
    {
        $this->id = $id;
        $this->guid = $guid;
        $this->password = $password;
    }

    /**
     * Creates and returns an empty user.
     *
     * @return User An empty User object.
     */
    public static function emptyUser(): User
    {
        return new self(-1, "", "");
    }
}