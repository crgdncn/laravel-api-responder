<?php

namespace Flugg\Responder\Pagination;

use Flugg\Responder\Contracts\Pagination\PaginatorFactory as PaginatorFactoryContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use League\Fractal\Pagination\Cursor;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Pagination\PaginatorInterface;

/**
 * A factory class for making Fractal paginator adapters from a Laravel paginator.
 *
 * @author  Alexander Tømmerås <flugged@gmail.com>
 * @license The MIT License
 */
class PaginatorFactory implements PaginatorFactoryContract
{
    /**
     * A list of query string values appended to the paginator links.
     *
     * @var array
     */
    protected $parameters;

    /**
     * Construct the factory class.
     *
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * Make a Fractal paginator adapter from a Laravel paginator.
     *
     * @param LengthAwarePaginator $paginator
     * @return PaginatorInterface
     */
    public function make(LengthAwarePaginator $paginator): PaginatorInterface
    {
        $paginator->appends($this->parameters);

        return new IlluminatePaginatorAdapter($paginator);
    }

    /**
     * Make a Fractal paginator adapter from a Laravel paginator.
     *
     * @param CursorPaginator $paginator
     * @return Cursor
     */
    public function makeCursor(CursorPaginator $paginator): Cursor
    {
        return new Cursor($paginator->cursor(), $paginator->previous(), $paginator->next(), $paginator->get()->count());
    }
}
