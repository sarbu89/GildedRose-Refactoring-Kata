<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testFoo(): void
    {
        $items = [new Item('foo', 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('foo', $items[0]->name);
        $this->assertSame(-1, $items[0]->sellIn);
        $this->assertSame(0, $items[0]->quality);
    }

    public function testAgedBrieQualityGoesUpAfterADayPassed(): void
    {
        $items = [new Item('Aged Brie', 2, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('Aged Brie', $items[0]->name);
        $this->assertSame(1, $items[0]->sellIn);
        $this->assertSame(1, $items[0]->quality);
    }

    public function testConjuredManaCakeDegradesTwiceAsFast(): void
    {
        $items = [new Item('Conjured Mana Cake', 3, 6)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('Conjured Mana Cake', $items[0]->name);
        $this->assertSame(2, $items[0]->sellIn);
        $this->assertSame(4, $items[0]->quality);
    }

    public function testBackstagePasse(): void
    {
        $items = [
            new Item('Backstage passes to a TAFKAL80ETC concert', 10, 26),
            new Item('Backstage passes to a TAFKAL80ETC concert', 5, 10),
            new Item('Backstage passes to a TAFKAL80ETC concert', 0, 50),
        ];

        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
//        1st quality goes up by 2
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $items[0]->name);
        $this->assertSame(9, $items[0]->sellIn);
        $this->assertSame(28, $items[0]->quality);

//        2nd quality goes up by 3 because 5 days or less
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $items[0]->name);
        $this->assertSame(4, $items[1]->sellIn);
        $this->assertSame(13, $items[1]->quality);

//        3rd quality goes to 0 because sellIn is -1 (concert passed)
        $this->assertSame('Backstage passes to a TAFKAL80ETC concert', $items[0]->name);
        $this->assertSame(-1, $items[2]->sellIn);
        $this->assertSame(0, $items[2]->quality);
    }

    public function testSulfurasDoesNotSellAndDoesNotDegrade(): void
    {
        $items = [new Item('Sulfuras, Hand of Ragnaros', 0, 80)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('Sulfuras, Hand of Ragnaros', $items[0]->name);
        $this->assertSame(0, $items[0]->sellIn);
        $this->assertSame(80, $items[0]->quality);
    }
}
