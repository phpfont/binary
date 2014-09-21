<?php

namespace PhpFont\BinaryTest;

use PhpFont\Binary\Stream;
use PhpFont\BinaryTest\Asset\TestStream;

class StreamTest extends \PHPUnit_Framework_TestCase
{
    private $resource;

    public function setUp()
    {
        parent::setUp();

        $this->resource = null;
    }

    public function tearDown()
    {
        if ($this->resource !== null) {
            fclose($this->resource);
        }

        parent::tearDown();
    }

    public function testReadZeroBytes()
    {
        $this->resource = fopen(__DIR__ . '/assets/non-font-file.txt', 'r');

        $stream = new TestStream($this->resource);

        $this->assertEquals('', $stream->readZeroBytes());
    }

    public function testReadMinusBytes()
    {
        $this->resource = fopen(__DIR__ . '/assets/non-font-file.txt', 'r');

        $stream = new TestStream($this->resource);

        $this->assertEquals('', $stream->readMinusBytes());
    }

    public function testGetEndianness()
    {
        $this->resource = fopen(__DIR__ . '/assets/non-font-file.txt', 'r');

        $stream = new Stream($this->resource);

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $this->assertEquals(Stream::BYTE_ORDER_LITTLE_ENDIAN, $stream->getEndianness());
        } else {
            $this->assertEquals(Stream::BYTE_ORDER_BIG_ENDIAN, $stream->getEndianness());
        }
    }

    public function testGetSize()
    {
        $this->resource = fopen(__DIR__ . '/assets/non-font-file.txt', 'r');

        $stream = new Stream($this->resource);

        $this->assertEquals(5, $stream->getSize());
    }

    public function testGetPosition()
    {
        $this->resource = fopen(__DIR__ . '/assets/non-font-file.txt', 'r');

        $stream = new Stream($this->resource);
        $stream->setPosition(1);

        $this->assertEquals(1, $stream->getPosition());
    }

    public function testSetPosition()
    {
        $this->resource = fopen(__DIR__ . '/assets/non-font-file.txt', 'r');

        $stream = new Stream($this->resource);
        $stream->setPosition(1);

        $this->assertEquals(1, $stream->getPosition());
    }

}
