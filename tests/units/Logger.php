<?php

namespace JDecool\ProtoLogger\Tests\Units;

use atoum;
use Psr\Log\InvalidArgumentException;
use Psr\Log\LogLevel;

class Logger extends atoum
{
    /**
     * @dataProvider getLogDataProvider
     */
    public function testLogWithoutContext($level, $message, array $context)
    {
        $this
            ->given($handler = new \mock\JDecool\ProtoLogger\Handler\Handler())
            ->if($this->newTestedInstance($handler))
            ->then
                ->given($this->testedInstance->log($level, $message, $context))
                ->mock($handler)
                    ->call('handle')
                        ->once()
        ;
    }

    /**
     * @dataProvider getLogDataProvider
     */
    public function testLogShortcutMethod($method, $message, array $context)
    {
        $this
            ->given($handler = new \mock\JDecool\ProtoLogger\Handler\Handler())
            ->if($this->newTestedInstance($handler))
            ->then
               ->given($this->testedInstance->$method($message, $context))
                ->mock($handler)
                    ->call('handle')
                        ->once()
        ;
    }

    public function getLogDataProvider()
    {
        return [
            ['debug', 'This is a log message', []],
            [LogLevel::EMERGENCY, 'This is a log message', []],
            [LogLevel::ALERT, 'This is a log message', []],
            [LogLevel::CRITICAL, 'This is a log message', []],
            [LogLevel::ERROR, 'This is a log message', []],
            [LogLevel::WARNING, 'This is a log message', []],
            [LogLevel::NOTICE, 'This is a log message', []],
            [LogLevel::INFO, 'This is a log message', []],
            [LogLevel::DEBUG, 'This is a log message', []],
        ];
    }

    public function testLogWithUnknowLogLevel()
    {
        $this
            ->given($handler = new \mock\JDecool\ProtoLogger\Handler\Handler())
            ->if($this->newTestedInstance($handler))
            ->then
                ->exception(function() {
                    $this->testedInstance->log('foo', 'bar');
                })
                    ->isInstanceOf(InvalidArgumentException::class)
        ;
    }
}
