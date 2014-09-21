<?php

namespace PhpFont\Binary;

class Stream implements StreamInterface
{
    /**
     * The handle to the stream.
     *
     * @var resource
     */
    private $handle;

    /**
     * Initializes a new instance of this class.
     *
     * @param resource $handle The handle to the resource.
     */
    public function __construct($handle)
    {
        $this->handle = $handle;
    }

    public function getEndianness()
    {
        // @codeCoverageIgnoreStart
        $value = 0x00FF;

        $packed = pack('S', $value);

        if ($value === current(unpack('v', $packed))) {
            return self::BYTE_ORDER_LITTLE_ENDIAN;
        }

        return self::BYTE_ORDER_BIG_ENDIAN;
        // @codeCoverageIgnoreEnd
    }

    public function getSize()
    {
        $currPos = ftell($this->handle);

        fseek($this->handle, 0, SEEK_END);
        $length = ftell($this->handle);

        fseek($this->handle, $currPos, SEEK_SET);

        return $length;
    }

    public function getPosition()
    {
        return ftell($this->handle);
    }

    public function setPosition($position)
    {
        fseek($this->handle, $position, SEEK_SET);
    }

    protected function read($bytes)
    {
        if ($bytes < 1) {
            return '';
        }

        return fread($this->handle, $bytes);
    }

    public function readFloat32()
    {
        $bytes = $this->read(4);

        $result = unpack('f', $bytes);

        return current($result);
    }

    public function readFloat32BE()
    {
        return $this->readFloat32();
    }

    public function readFloat32LE()
    {
        return $this->readFloat32();
    }

    public function readFloat64()
    {
        $bytes = $this->read(8);

        $result = unpack('d', $bytes);

        return current($result);
    }

    public function readFloat64BE()
    {
        return $this->readFloat64();
    }

    public function readFloat64LE()
    {
        return $this->readFloat64();
    }

    public function readInt16()
    {
        $bytes = $this->read(2);

        $unpacked = unpack('s', $bytes);

        $value = current($unpacked);

        while ($value >= 0x8000) {
            $value -= 0x10000;
        }

        return $value;
    }

    public function readInt16BE()
    {
        $bytes = $this->read(2);

        $unpacked = unpack('n', $bytes);

        $value = current($unpacked);

        while ($value >= 0x8000) {
            $value -= 0x10000;
        }

        return $value;
    }

    public function readInt16LE()
    {
        $bytes = $this->read(2);

        $unpacked = unpack('v', $bytes);

        $value = current($unpacked);

        while ($value >= 0x8000) {
            $value -= 0x10000;
        }

        return $value;
    }

    public function readInt32()
    {
        $bytes = $this->read(4);

        $unpacked = unpack('L', $bytes);

        return current($unpacked);
    }

    public function readInt32BE()
    {
        $bytes = $this->read(4);

        $unpacked = unpack('N', $bytes);

        return current($unpacked);
    }

    public function readInt32LE()
    {
        $bytes = $this->read(4);

        $unpacked = unpack('V', $bytes);

        return current($unpacked);
    }

    public function readInt8()
    {
        $bytes = $this->read(1);

        $unpacked = unpack('c', $bytes);

        return current($unpacked);
    }

    public function readInt8BE()
    {
        return $this->readInt8();
    }

    public function readInt8LE()
    {
        return $this->readInt8();
    }

    public function readString($length)
    {
        $bytes = $this->read($length);

        $unpacked = unpack('a' . $length, $bytes);

        return current($unpacked);
    }

    public function readUInt16()
    {
        $bytes = $this->read(2);

        $unpacked = unpack('S', $bytes);

        $value = current($unpacked);

        while ($value > 0xffff) {
            $value -= 0x10000;
        }

        return $value;
    }

    public function readUInt16BE()
    {
        $bytes = $this->read(2);

        $unpacked = unpack('n', $bytes);

        $value = current($unpacked);

        while ($value > 0xffff) {
            $value -= 0x10000;
        }

        return $value;
    }

    public function readUInt16LE()
    {
        $bytes = $this->read(2);

        $unpacked = unpack('v', $bytes);

        $value = current($unpacked);

        while ($value > 0xffff) {
            $value -= 0x10000;
        }

        return $value;
    }

    public function readUInt32()
    {
        $bytes = $this->read(4);

        $unpacked = unpack('L', $bytes);

        return current($unpacked);
    }

    public function readUInt32BE()
    {
        $bytes = $this->read(4);

        $unpacked = unpack('N', $bytes);

        return current($unpacked);
    }

    public function readUInt32LE()
    {
        $bytes = $this->read(4);

        $unpacked = unpack('V', $bytes);

        return current($unpacked);
    }

    public function readUInt8()
    {
        $bytes = $this->read(1);

        $unpacked = unpack('C', $bytes);

        $result = current($unpacked);

        while ($result > 0xff) {
            $result -= 0x100;
        }

        return $result;
    }

    public function readUInt8BE()
    {
        return $this->readUInt8();
    }

    public function readUInt8LE()
    {
        return $this->readUInt8();
    }

    public function writeFloat32($value)
    {
        $bytes = pack('f', $value);

        fwrite($this->handle, $bytes);
    }

    public function writeFloat32BE($value)
    {
        $this->writeFloat32($value);
    }

    public function writeFloat32LE($value)
    {
        $this->writeFloat32($value);
    }

    public function writeFloat64($value)
    {
        $bytes = pack('d', $value);

        fwrite($this->handle, $bytes);
    }

    public function writeFloat64BE($value)
    {
        $this->writeFloat64($value);
    }

    public function writeFloat64LE($value)
    {
        $this->writeFloat64($value);
    }

    public function writeInt16($value)
    {
        while ($value >= 0x8000) {
            $value -= 0x10000;
        }

        $bytes = pack('s', $value);

        fwrite($this->handle, $bytes);
    }

    public function writeInt16BE($value)
    {
        while ($value >= 0x8000) {
            $value -= 0x10000;
        }

        $bytes = pack('n', $value);

        fwrite($this->handle, $bytes);
    }

    public function writeInt16LE($value)
    {
        while ($value >= 0x8000) {
            $value -= 0x10000;
        }

        $bytes = pack('v', $value);

        fwrite($this->handle, $bytes);
    }

    public function writeInt32($value)
    {
        // There is no need in checking for overflow, PHP doesn't handle integers bigger than int32.

        $bytes = pack('l', $value);

        fwrite($this->handle, $bytes);
    }

    public function writeInt32BE($value)
    {
        // There is no need in checking for overflow, PHP doesn't handle integers bigger than int32.

        $bytes = pack('N', $value);

        fwrite($this->handle, $bytes);
    }

    public function writeInt32LE($value)
    {
        // There is no need in checking for overflow, PHP doesn't handle integers bigger than int32.

        $bytes = pack('V', $value);

        fwrite($this->handle, $bytes);
    }

    public function writeInt8($value)
    {
        while ($value >= 0x80) {
            $value -= 0x100;
        }

        $bytes = pack('c', $value);

        fwrite($this->handle, $bytes);
    }

    public function writeInt8BE($value)
    {
        $this->writeInt8($value);
    }

    public function writeInt8LE($value)
    {
        $this->writeInt8($value);
    }

    public function writeString($value)
    {
        $bytes = pack('a' . strlen($value), $value);

        fwrite($this->handle, $bytes);
    }

    public function writeUInt16($value)
    {
        while ($value > 0xffff) {
            $value -= 0x10000;
        }

        $bytes = pack('S', $value);

        fwrite($this->handle, $bytes);
    }

    public function writeUInt16BE($value)
    {
        while ($value > 0xffff) {
            $value -= 0x10000;
        }

        $bytes = pack('n', $value);

        fwrite($this->handle, $bytes);
    }

    public function writeUInt16LE($value)
    {
        while ($value > 0xffff) {
            $value -= 0x10000;
        }

        $bytes = pack('v', $value);

        fwrite($this->handle, $bytes);
    }

    public function writeUInt32($value)
    {
        $bytes = pack('L', $value);

        fwrite($this->handle, $bytes);
    }

    public function writeUInt32BE($value)
    {
        $bytes = pack('N', $value);

        fwrite($this->handle, $bytes);
    }

    public function writeUInt32LE($value)
    {
        $bytes = pack('V', $value);

        fwrite($this->handle, $bytes);
    }

    public function writeUInt8($value)
    {
        while ($value > 0xff) {
            $value -= 0x100;
        }

        $bytes = pack('C', $value);

        fwrite($this->handle, $bytes);
    }

    public function writeUInt8BE($value)
    {
        $this->writeUInt8($value);
    }

    public function writeUInt8LE($value)
    {
        $this->writeUInt8($value);
    }

}
