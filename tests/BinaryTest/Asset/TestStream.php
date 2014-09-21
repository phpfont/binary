<?php

namespace PhpFont\BinaryTest\Asset;

use PhpFont\Binary\Stream;

class TestStream extends Stream
{
    public function readZeroBytes()
    {
        return $this->read(0);
    }

    public function readMinusBytes()
    {
        return $this->read(-1);
    }
}
