<?php

namespace JDecool\ProtoLogger\Handler;

use JDecool\ProtoLogger\Model\Log;
use InvalidArgumentException;
use UnexpectedValueException;

class StreamHandler implements Handler
{
    /** @var resource|string */
    private $stream;

    /**
     * Create handler from path
     *
     * @param string $url
     * @return StreamHandler
     */
    public static function createFromUrl($url)
    {
        $stream = fopen($url, 'a+');
        if (!is_resource($stream)) {
            throw new UnexpectedValueException(sprintf('The stream or file "%s" could not be opened.', $url));
        }

        return new self($stream);
    }

    /**
     * Constructor
     *
     * @param resource $stream
     */
    public function __construct($stream)
    {
        if (!is_resource($stream)) {
            throw new InvalidArgumentException("Stream is not valid.");
        }

        $this->stream = $stream;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Log $log)
    {
        fwrite($this->stream, $log->serializeToString());
    }
}
