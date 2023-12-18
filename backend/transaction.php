<?php

/**
 * Represents a transaction.
 *
 * This class models a transaction, including its name, seller ID, price, and date.
 */

class Transaction
{
    /**
     * Constructor for the Transaction class.
     *
     * @param string $name The name of the transaction item.
     * @param string $sellerId The seller's ID.
     * @param float $price The price of the transaction item.
     * @param string $date The date of the transaction.
     */
    public function __construct(string $name, string $sellerId, float $price, string $date)
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
}
