<?php

declare(strict_types=1);

abstract class Entity
{
}

final class Product extends Entity
{
}

/**
 * @template TEntity of Entity
 */
abstract class AbstractMapper
{
    /**
     * @param TEntity $entity
     */
    public function store(Entity $entity): void
    {
    }
}

/**
 * @template TEntity of Entity
 *
 * @extends AbstractMapper<TEntity>
 */
abstract class BaseMapper extends AbstractMapper
{
}

final class DirectMapper extends AbstractMapper
{
    public function save(Product $product): void
    {
        $this->store($product);
    }
}

final class ProductMapper extends BaseMapper
{
    public function save(Product $product): void
    {
        $this->store($product);
    }
}
