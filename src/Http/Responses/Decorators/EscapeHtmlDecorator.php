<?php /** @noinspection ALL */

namespace Flugg\Responder\Http\Responses\Decorators;

use Illuminate\Http\JsonResponse;

/**
 * A decorator class for escaping HTML entities in strings on the response.
 *
 * @author  Paolo Caleffi <p.caleffi@dreamonkey.com>
 * @license The MIT License
 */
class EscapeHtmlDecorator extends ResponseDecorator
{
    /**
     * Generate a JSON response.
     *
     * @param  array $data
     * @param  int   $status
     * @param  array $headers
     * @return \Illuminate\Http\JsonResponse
     * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
     */
    public function make(array $data, int $status, array $headers = []): JsonResponse
    {
        array_walk_recursive($data, function (&$value) {
            if (is_string($value)) {
                $value = e($value);
            }
        });

        return $this->factory->make($data, $status, $headers);
    }
}
