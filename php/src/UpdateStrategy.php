<?php

namespace GildedRose;

interface UpdateStrategy
{
    public function update(Item $item): void;
}