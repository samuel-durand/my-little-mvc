<?php

namespace src\Model\Interface;

interface StockableInterface
{

    public function addStock(int $quantity): static;

    public function removeStock(int $quantity): static;

}