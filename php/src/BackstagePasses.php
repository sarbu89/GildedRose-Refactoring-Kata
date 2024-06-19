<?php

namespace GildedRose;

class BackstagePasses implements UpdateStrategy {

    public function update(Item $item): void {

        $item->sellIn--;

        if ($item->quality < 50) {

            $item->quality++;

            if ($item->sellIn < 11) {
                if ($item->quality < 50) {
                    $item->quality++;
                }
            }

            if ($item->sellIn < 6) {
                if ($item->quality < 50) {
                    $item->quality++;
                }
            }
        }

        if ($item->sellIn < 0) {
            $item->quality = 0;
        }
    }
}