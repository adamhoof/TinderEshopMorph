<?php

class Item
{
    public function __construct($itemId, $name, $price, $categories, $seller_id)
    {
        $this->itemId = $itemId;
        $this->name = $name;
        $this->price = $price;
        $this->categories = $categories;
        $this->seller_id = $seller_id;
    }

    public int $itemId;

    public string $name;
    public float $price;
    public array $categories;
    public int $seller_id;

    public static function emptyItem(): Item
    {
        return new self(-1, "", 0, [], -1);
    }
}