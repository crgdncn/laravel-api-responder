<?php /** @noinspection ALL */

/** @noinspection ALL */

namespace Flugg\Responder;

use Flugg\Responder\Contracts\ErrorMessageResolver as ErrorMessageResolverContract;
use Illuminate\Translation\Translator;

/**
 * A resolver class responsible for resolving messages from error codes.
 *
 * @author  Alexander Tømmerås <flugged@gmail.com>
 * @license The MIT License
 */
class ErrorMessageResolver implements ErrorMessageResolverContract
{
    /**
     * A service for resolving messages from language files.
     *
     * @var \Illuminate\Translation\Translator
     * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
     */
    protected $translator;

    /**
     * A list of registered messages mapped to error codes.
     *
     * @var array
     */
    protected $messages = [];

    /**
     * Construct the resolver class.
     *
     * @param \Illuminate\Translation\Translator $translator
     * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
     */
    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    /**
     * Register a message mapped to an error code.
     *
     * @param  mixed  $errorCode
     * @param  string $message
     * @return void
     */
    public function register(mixed $errorCode, string $message): void
    {
        $this->messages = array_merge($this->messages, is_array($errorCode) ? $errorCode : [
            $errorCode => $message,
        ]);
    }

    /**
     * Resolve a message from the given error code.
     *
     * @param mixed $errorCode
     * @return string|null
     */
    public function resolve(mixed $errorCode): ?string
    {
        if (key_exists($errorCode, $this->messages)) {
            return $this->messages[$errorCode];
        }

        if ($this->translator->has($errorCode = "errors.$errorCode")) {
            return $this->translator->get($errorCode);
        }

        return null;
    }
}
