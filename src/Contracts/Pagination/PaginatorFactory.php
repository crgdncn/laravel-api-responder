<?php

namespace Flugg\Responder\Contracts\Pagination;

use Flugg\Responder\Pagination\CursorPaginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use League\Fractal\Pagination\Cursor;
use League\Fractal\Pagination\PaginatorInterface;

/**
 * A contract for creating pagination adapters.
 *
 * @author  Alexander Tømmerås <flugged@gmail.com>
 * @license The MIT License
 */
interface PaginatorFactory
{
    /**
     * Make a Fractal paginator adapter from a Laravel paginator.
     *
     * @param LengthAwarePaginator $paginator
     * @return PaginatorInterface
     */
    public function make(LengthAwarePaginator $paginator): PaginatorInterface;

    /**
     * Make a Fractal paginator adapter from a Laravel paginator.
     *
     * @param CursorPaginator $paginator
     * @return Cursor
     */
    public function makeCursor(CursorPaginator $paginator): Cursor;
}
