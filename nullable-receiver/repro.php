<?php

declare(strict_types=1);

final class Title
{
    public string $value = 'x';
}

final class Item
{
    public function getTitle(): Title
    {
        return new Title();
    }
}

function direct(?Item $item): Title
{
    return $item->getTitle();
}

function chained(?Item $item): string
{
    return $item->getTitle()->value;
}
