<?php

class Transaction
{
    public function __construct($name, $sellerId, $price, $date)
    {
        $this->name = $name;
        $this->sellerId = $sellerId;
        $this->price = $price;
        $this->date = $date;
    }

    public string $name;
    public string $sellerId;
    public float $price;
    public string $date;

    public static function emptyTransaction(): Transaction
    {
        return new self("", "", 0.0, "");
    }
}
