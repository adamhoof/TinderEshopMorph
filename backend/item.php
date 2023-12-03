<?php

class item
{
    public function __construct($name, $price, $picUrl, $categories, $seller_guid)
    {
        $this->name = $name;
        $this->price = $price;
        $this->picUrl = $picUrl;
        $this->categories = $categories;
        $this->seller_guid = $seller_guid;
    }
    public string $name;
    public float $price;
    public string $picUrl;
    public array $categories;
    public string $seller_guid;

    public static function emptyItem(): item
    {
        return new self("", 0, "", [], "");
    }
}