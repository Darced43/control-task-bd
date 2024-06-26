<?php

class PriceCategory {
    private int $price;
    private int $category;

    public function __construct(
        int $price,
        int $category
    ) {
        $this->price = $price;
        $this->category = $category;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getCategory(): int
    {
        return $this->category;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function getPriceMultCat(): int
    {
        return $this->price * $this->category;
    }
}
function getPriceAndCategory()
{


    return new PriceCategory(100, 2);
}

function ret(): array
{
    return [
        'price' => 100,
        'category' => 35
    ];
}

$result = ret();
echo $result[0];
echo $result['price'];
echo $result['category'];

$priceCategory = getPriceAndCategory();
$priceCategory->setPrice(655);
$priceCategory->getPriceMultCat();


echo $priceCategory->getPrice();
echo $priceCategory->getCategory();
