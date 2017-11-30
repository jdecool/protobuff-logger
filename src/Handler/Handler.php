<?php

namespace JDecool\ProtoLogger\Handler;

use JDecool\ProtoLogger\Model\Log;

interface Handler
{
    /**
     * Handle a log record
     *
     * @param Log $log
     */
    public function handle(Log $log);
}
