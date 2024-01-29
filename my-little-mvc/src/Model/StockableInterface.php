<?php

namespace App\Model;

interface StockableInterface
{

    public function addStock(int $quantity): static;

    public function removeStock(int $quantity): static;

}