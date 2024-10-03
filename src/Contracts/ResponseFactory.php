<?php /** @noinspection ALL */

namespace Flugg\Responder\Contracts;

use Illuminate\Http\JsonResponse;

/**
 * A contract for creating JSON responses.
 *
 * @author  Alexander Tømmerås <flugged@gmail.com>
 * @license The MIT License
 */
interface ResponseFactory
{
    /**
     * Generate a JSON response.
     *
     * @param  array $data
     * @param  int   $status
     * @param  array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public function make(array $data, int $status, array $headers = []): JsonResponse;
}
