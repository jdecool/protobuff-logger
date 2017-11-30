<?php

namespace JDecool\ProtoLogger;

use Google\Protobuf\Timestamp;
use JDecool\ProtoLogger\Handler\Handler;
use JDecool\ProtoLogger\Model\Log;
use JDecool\ProtoLogger\Model\Log_Level as ProtoLevel;
use Psr\Log\AbstractLogger;
use Psr\Log\InvalidArgumentException;
use Psr\Log\LogLevel as PsrLevel;

class Logger extends AbstractLogger
{
    /** @var Handler */
    private $handler;

    /** @var string[] */
    private $levelMap = [
        PsrLevel::EMERGENCY => ProtoLevel::EMERGENCY,
        PsrLevel::ALERT => ProtoLevel::ALERT,
        PsrLevel::CRITICAL => ProtoLevel::CRITICAL,
        PsrLevel::ERROR => ProtoLevel::ERROR,
        PsrLevel::WARNING => ProtoLevel::WARNING,
        PsrLevel::NOTICE => ProtoLevel::NOTICE,
        PsrLevel::INFO => ProtoLevel::INFO,
        PsrLevel::DEBUG => ProtoLevel::DEBUG,
    ];

    /**
     * Constructor
     *
     * @param Handler $handler
     */
    public function __construct(Handler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * {@inheritdoc}
     */
    public function log($level, $message, array $context = array())
    {
        if (!isset($this->levelMap[$level])) {
            throw new InvalidArgumentException(sprintf('The log level "%s" does not exist.', $level));
        }

        $log = new Log();
        $log->setDate((new Timestamp())->setSeconds(time()));
        $log->setLevel($this->levelMap[$level]);
        $log->setMessage($message);
        $log->setContext($context);

        $this->write($log);
    }

    /**
     * Save the log
     *
     * @param Log $log
     */
    public function write(Log $log)
    {
        $this->handler->handle($log);
    }
}
