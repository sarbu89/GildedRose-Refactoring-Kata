<?php

namespace GildedRose;

class AgedBrie implements UpdateStrategy
{
    public function update(Item $item): void {

        $item->sellIn--;

        if ($item->quality < 50) {
            $item->quality++;
        }

        if ($item->sellIn < 0 && $item->quality < 50) {
            $item->quality++;
        }
    }
}