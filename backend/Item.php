<?php

class Item
{
    public function __construct($itemId, $name, $price, $picUrl, $categories, $seller_guid)
    {
        $this->itemId = $itemId;
        $this->name = $name;
        $this->price = $price;
        $this->picUrl = $picUrl;
        $this->categories = $categories;
        $this->seller_guid = $seller_guid;
    }
    public int $itemId;

    public string $name;
    public float $price;
    public string $picUrl;
    public array $categories;
    public string $seller_guid;

    public static function emptyItem(): Item
    {
        return new self(-1,"", 0, "", [], "");
    }
}