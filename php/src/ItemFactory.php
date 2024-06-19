<?php

namespace GildedRose;

class ItemFactory
{
    public static function create(string $itemName): UpdateStrategy {

        return match ($itemName) {
            'Aged Brie' => new AgedBrie(),
            'Backstage passes to a TAFKAL80ETC concert' => new BackstagePasses(),
            'Sulfuras, Hand of Ragnaros' => new Sulfuras(),
            'Conjured Mana Cake' => new ConjuredManaCake(),
            default => new CommonItem(),
        };
    }
}