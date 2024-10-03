<?php

namespace Flugg\Responder\Pagination;

use Closure;
use Illuminate\Support\Collection;
use LogicException;

/**
 * A paginator class for handling cursor-based pagination.
 *
 * @author  Alexander Tømmerås <flugged@gmail.com>
 * @license The MIT License
 */
class CursorPaginator
{
    /**
     * A list of the items being paginated.
     *
     * @var Collection
     */
    protected $items;

    /**
     * The current cursor reference.
     *
     * @var int|string|null
     */
    protected $cursor;

    /**
     * The previous cursor reference.
     *
     * @var int|string|null
     */
    protected $previousCursor;

    /**
     * The next cursor reference.
     *
     * @var int|string|null
     */
    protected $nextCursor;

    /**
     * The current cursor resolver callback.
     *
     * @var \Closure|null
     */
    protected static $currentCursorResolver;

    /**
     * Create a new paginator instance.
     *
     * @param array|Collection|null $data
     * @param int|string|null $cursor
     * @param int|string|null $previousCursor
     * @param int|string|null $nextCursor
     */
    public function __construct(array|Collection|null $data, int|string|null $cursor, int|string|null $previousCursor, int|string|null $nextCursor)
    {
        $this->cursor = $cursor;
        $this->previousCursor = $previousCursor;
        $this->nextCursor = $nextCursor;

        $this->set($data);
    }

    /**
     * Retrieve the current cursor reference.
     *
     * @return int|string|null
     */
    public function cursor(): int|string|null
    {
        return $this->cursor;
    }

    /**
     * Retrieve the next cursor reference.
     *
     * @return int|string|null
     */
    public function previous(): int|string|null
    {
        return $this->previousCursor;
    }

    /**
     * Retrieve the next cursor reference.
     *
     * @return int|string|null
     */
    public function next(): int|string|null
    {
        return $this->nextCursor;
    }

    /**
     * Get the slice of items being paginated.
     *
     * @return array
     */
    public function items(): array
    {
        return $this->items->all();
    }

    /**
     * Get the paginator's underlying collection.
     *
     * @return Collection
     */
    public function get(): Collection
    {
        return $this->items;
    }

    /**
     * Set the paginator's underlying collection.
     *
     * @param array|Collection|null $data
     * @return self
     */
    public function set(array|Collection|null $data): CursorPaginator
    {
        $this->items = $data instanceof Collection ? $data : collect($data);

        return $this;
    }

    /**
     * Resolve the current cursor using the cursor resolver.
     *
     * @param  string $name
     * @return mixed
     * @throws \LogicException
     */
    public static function resolveCursor(string $name = 'cursor'): mixed
    {
        if (isset(static::$currentCursorResolver)) {
            return call_user_func(static::$currentCursorResolver, $name);
        }

        throw new LogicException("Could not resolve cursor with the name [{$name}].");
    }

    /**
     * Set the current cursor resolver callback.
     *
     * @param  \Closure $resolver
     * @return void
     */
    public static function cursorResolver(Closure $resolver): void
    {
        static::$currentCursorResolver = $resolver;
    }
}
