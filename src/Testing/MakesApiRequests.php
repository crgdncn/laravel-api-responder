<?php

namespace Flugg\Responder\Testing;

use Flugg\Responder\Responder;
use Illuminate\Http\JsonResponse;

/**
 * A trait to be used by test case classes to give access to additional assertion methods.
 *
 * @author  Alexander Tømmerås <flugged@gmail.com>
 * @license The MIT License
 */
trait MakesApiRequests
{
    /**
     * Assert that the response is a valid success response.
     *
     * @param mixed|null $data
     * @param int $status
     * @return $this
     */
    protected function seeSuccess(mixed $data = null, int $status = 200): static
    {
        $response = $this->seeSuccessResponse($data, $status);
        $this->seeSuccessData($response->getData(true)['data']);

        return $this;
    }

    /**
     * Assert that the response is a valid success response.
     *
     * @param mixed|null $data
     * @param int $status
     * @return $this
     */
    protected function seeSuccessEquals(mixed $data = null, int $status = 200): static
    {
        $response = $this->seeSuccessResponse($data, $status);
        $this->seeJsonEquals($response->getData(true));

        return $this;
    }

    /**
     * Assert that the response data contains the given structure.
     *
     * @param mixed|null $data
     * @return $this
     */
    protected function seeSuccessStructure(mixed $data = null): static
    {
        $this->seeJsonStructure([
            'data' => $data,
        ]);

        return $this;
    }

    /**
     * Assert that the response is a valid success response.
     *
     * @param mixed|null $data
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function seeSuccessResponse(mixed $data = null, int $status = 200): JsonResponse
    {
        $response = $this->app->make(Responder::class)->success($data, $status);

        $this->seeStatusCode($response->getStatusCode())->seeJson([
            'success' => true,
            'status' => $response->getStatusCode(),
        ])->seeJsonStructure(['data']);

        return $response;
    }

    /**
     * Assert that the response data contains given values.
     *
     * @param mixed|null $data
     * @return $this
     */
    protected function seeSuccessData(mixed $data = null): static
    {
        collect($data)->each(function ($value, $key) {
            if (is_array($value)) {
                $this->seeSuccessData($value);
            } else {
                $this->seeJson([$key => $value]);
            }
        });

        return $this;
    }

    /**
     * Decodes JSON response and returns the data.
     *
     * @param array|string|null $attributes
     * @return array
     */
    protected function getSuccessData(array|string $attributes = null): array
    {
        $rawData = $this->decodeResponseJson()['data'];

        if (is_null($attributes)) {
            return $rawData;
        } elseif (is_string($attributes)) {
            return array_get($rawData, $attributes);
        }

        $data = [];

        foreach ($attributes as $attribute) {
            $data[] = array_get($rawData, $attribute);
        }

        return $data;
    }

    /**
     * Assert that the response is a valid error response.
     *
     * @param  string   $error
     * @param  int|null $status
     * @return $this
     */
    protected function seeError(string $error, int $status = null): static
    {
        if (! is_null($status)) {
            $this->seeStatusCode($status);
        }

        if ($this->app->config->get('responder.status_code')) {
            $this->seeJson([
                'status' => $status,
            ]);
        }

        return $this->seeJson([
            'success' => false,
        ])->seeJsonSubset([
            'error' => [
                'code' => $error,
            ],
        ]);
    }

    /**
     * Asserts that the status code of the response matches the given code.
     *
     * @param int $status
     * @return $this
     */
    abstract protected function seeStatusCode(int $status): static;

    /**
     * Assert that the response contains JSON.
     *
     * @param  array|null $data
     * @param bool $negate
     * @return $this
     */
    abstract public function seeJson(array $data = null, bool $negate = false): static;

    /**
     * Assert that the JSON response has a given structure.
     *
     * @param  array|null $structure
     * @param array|null $responseData
     * @return $this
     */
    abstract public function seeJsonStructure(array $structure = null, array $responseData = null): static;

    /**
     * Assert that the response is a superset of the given JSON.
     *
     * @param  array $data
     * @return $this
     */
    abstract protected function seeJsonSubset(array $data): static;

    /**
     * Assert that the response contains an exact JSON array.
     *
     * @param  array $data
     * @return $this
     */
    abstract public function seeJsonEquals(array $data): static;

    /**
     * Validate and return the decoded response JSON.
     *
     * @return array
     */
    abstract protected function decodeResponseJson(): array;
}
