<?php

namespace JDecool\ProtoLogger\Tests\Units\Handler;

use atoum;
use Google\Protobuf\Timestamp;
use JDecool\ProtoLogger\Handler\StreamHandler as TestedClass;
use JDecool\ProtoLogger\Model\Log;
use JDecool\ProtoLogger\Model\Log_Level;

/**
 * @engine inline
 */
class StreamHandler extends atoum
{
    private $workspace;

    public function setUp()
    {
        $this->workspace = sprintf('%s/%s.%s', sys_get_temp_dir(), microtime(true), mt_rand());
        mkdir($this->workspace, 0777, true);
    }

    public function testStreamResource()
    {
        $this
            ->given(
                $stream = fopen('php://memory', 'a+'),
                $log = $this->createLog()
            )
            ->if($this->newTestedInstance($stream))
            ->then
                ->given($this->testedInstance->handle($log))
                ->string(stream_get_contents($stream, -1, 0))
                    ->isEqualTo($log->serializeToString())
        ;
    }

    public function testConstructorWithNoValidResource()
    {
        $this
            ->given($file = sprintf('%s/test.log', $this->workspace))
            ->then
                ->exception(function() use ($file) {
                    $this->newTestedInstance($file);
                })
                    ->isInstanceOf('InvalidArgumentException')
        ;
    }

    public function testStreamFile()
    {
        $this
            ->given(
                $file = sprintf('%s/test.log', $this->workspace),
                $log = $this->createLog()
            )
            ->if($testedInstance = TestedClass::createFromUrl($file))
            ->then
                ->given($testedInstance->handle($log))
                ->string(file_get_contents($file))
                    ->isEqualTo($log->serializeToString())
        ;
    }

    private function createLog()
    {
        $log = new Log();
        $log->setDate((new Timestamp())->setSeconds(1511813987));
        $log->setLevel(Log_Level::DEBUG);
        $log->setMessage('foo');

        return $log;
    }
}
