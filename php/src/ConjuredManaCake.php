<?php

namespace GildedRose;

class ConjuredManaCake implements UpdateStrategy
{

    public function update(Item $item): void {

        $item->sellIn--;

        if ($item->quality > 0) {
            $item->quality -= 2;
        }
        if ($item->sellIn < 0 && $item->quality > 0) {
            $item->quality -= 2;
        }
        if ($item->quality < 0) {
            $item->quality = 0;
        }
    }
}