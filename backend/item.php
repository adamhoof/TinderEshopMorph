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