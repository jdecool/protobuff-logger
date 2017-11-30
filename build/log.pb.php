<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: log.proto

namespace JDecool\ProtoLogger\Model;

require_once('google/protobuf/timestamp.pb.php');
use Google\Protobuf\Internal\DescriptorPool;
use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

class Log extends \Google\Protobuf\Internal\Message
{
    private $date = null;
    private $level = 0;
    private $message = '';
    private $context;

    public function getDate()
    {
        return $this->date;
    }

    public function setDate(&$var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->date = $var;
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function setLevel($var)
    {
        GPBUtil::checkEnum($var, \JDecool\ProtoLogger\Model\Log_Level::class);
        $this->level = $var;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($var)
    {
        GPBUtil::checkString($var, True);
        $this->message = $var;
    }

    public function getContext()
    {
        return $this->context;
    }

    public function setContext(&$var)
    {
        $this->context = $var;
    }

}

class Log_Level
{
    const EMERGENCY = 0;
    const ALERT = 1;
    const CRITICAL = 2;
    const ERROR = 3;
    const WARNING = 4;
    const NOTICE = 5;
    const INFO = 6;
    const DEBUG = 7;
}

$pool = DescriptorPool::getGeneratedPool();

$pool->internalAddGeneratedFile(hex2bin(
    "0a9f030a096c6f672e70726f746f12194a4465636f6f6c2e50726f746f4c" .
    "6f676765722e4d6f64656c1a1f676f6f676c652f70726f746f6275662f74" .
    "696d657374616d702e70726f746f22cd020a034c6f6712280a0464617465" .
    "18012001280b321a2e676f6f676c652e70726f746f6275662e54696d6573" .
    "74616d7012330a056c6576656c18022001280e32242e4a4465636f6f6c2e" .
    "50726f746f4c6f676765722e4d6f64656c2e4c6f672e4c6576656c120f0a" .
    "076d657373616765180320012809123c0a07636f6e746578741804200328" .
    "0b322b2e4a4465636f6f6c2e50726f746f4c6f676765722e4d6f64656c2e" .
    "4c6f672e436f6e74657874456e7472791a2e0a0c436f6e74657874456e74" .
    "7279120b0a036b6579180120012809120d0a0576616c7565180220012809" .
    "3a02380122680a054c6576656c120d0a09454d455247454e435910001209" .
    "0a05414c4552541001120c0a08435249544943414c100212090a05455252" .
    "4f521003120b0a075741524e494e471004120a0a064e4f54494345100512" .
    "080a04494e464f100612090a0544454255471007620670726f746f33"
));
