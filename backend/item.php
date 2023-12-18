<?php

/**
 * Represents an item.
 *
 * This class is used to represent the structure of an item, including its ID, name,
 * price, categories, and the seller's ID.
 */
class Item
{
    /**
     * Constructor for the Item class.
     *
     * @param int $itemId The ID of the item.
     * @param string $name The name of the item.
     * @param string $price The price of the item.
     * @param array $categories The categories of the item.
     * @param int $seller_id The seller's ID.
     */
    public function __construct(int $itemId, string $name, string $price, array $categories, int $seller_id)
    {
        $this->itemId = $itemId;
        $this->name = $name;
        $this->price = $price;
        $this->categories = $categories;
        $this->seller_id = $seller_id;
    }

    public int $itemId;
    public string $name;
    public string $price;
    public array $categories;
    public int $seller_id;

    /**
     * Creates and returns an empty item.
     *
     * @return Item An empty Item object.
     */
    public static function emptyItem(): Item
    {
        return new self(-1, "", "", [], -1);
    }
}