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
        $value = 0x00FF;

        $packed = pack('S', $value);

        if ($value === current(unpack('v', $packed))) {
            return self::BYTE_ORDER_LITTLE_ENDIAN;
        }

        return self::BYTE_ORDER_BIG_ENDIAN;
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
        $d = $this->readInt16();
        $d2 = $this->readUInt16();

        return round($d + $d2 / 0x10000, 4);
    }

    public function readFloat32BE()
    {
        $d = $this->readInt16BE();
        $d2 = $this->readUInt16BE();

        return round($d + $d2 / 0x10000, 4);
    }

    public function readFloat32LE()
    {
        $d = $this->readInt16LE();
        $d2 = $this->readUInt16LE();

        return round($d + $d2 / 0x10000, 4);
    }

    public function readFloat64()
    {
        return $this->readFloat32();
    }

    public function readFloat64BE()
    {
        return $this->readFloat32BE();
    }

    public function readFloat64LE()
    {
        return $this->readFloat32LE();
    }

    public function readInt16()
    {
        $bytes = $this->read(2);

        $unpacked = unpack('s', $bytes);

        return current($unpacked);
    }

    public function readInt16BE()
    {
        $bytes = $this->read(2);

        $unpacked = unpack('n', $bytes);

        return current($unpacked);
    }

    public function readInt16LE()
    {
        $bytes = $this->read(2);

        $unpacked = unpack('v', $bytes);

        return current($unpacked);
    }

    public function readInt32()
    {
        return $this->readUInt32();
    }

    public function readInt32BE()
    {
        return $this->readUInt32BE();
    }

    public function readInt32LE()
    {
        return $this->readUInt32LE();
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

        return current($unpacked);
    }

    public function readUInt16BE()
    {
        $bytes = $this->read(2);

        $unpacked = unpack('n', $bytes);

        return current($unpacked);
    }

    public function readUInt16LE()
    {
        $bytes = $this->read(2);

        $unpacked = unpack('v', $bytes);

        return current($unpacked);
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
        return $this->readInt8();
    }

    public function readUInt8BE()
    {
        return $this->readInt8BE();
    }

    public function readUInt8LE()
    {
        return $this->readInt8LE();
    }

    public function writeFloat32($value)
    {
        $left = floor($value);
        $right = ($value - $left) * 0x10000;

        $this->writeInt16($left);
        $this->writeUInt16($right);
    }

    public function writeFloat32BE($value)
    {
        $left = floor($value);
        $right = ($value - $left) * 0x10000;

        $this->writeInt16BE($left);
        $this->writeUInt16BE($right);
    }

    public function writeFloat32LE($value)
    {
        $left = floor($value);
        $right = ($value - $left) * 0x10000;

        $this->writeInt16LE($left);
        $this->writeUInt16LE($right);
    }

    public function writeFloat64($value)
    {
        $this->writeFloat32($value);
    }

    public function writeFloat64BE($value)
    {
        $this->writeFloat32BE($value);
    }

    public function writeFloat64LE($value)
    {
        $this->writeFloat32LE($value);
    }

    public function writeInt16($value)
    {
        $bytes = pack('s', $value);

        fwrite($this->handle, $bytes);
    }

    public function writeInt16BE($value)
    {
        $bytes = pack('n', $value);

        fwrite($this->handle, $bytes);
    }

    public function writeInt16LE($value)
    {
        $bytes = pack('v', $value);

        fwrite($this->handle, $bytes);
    }

    public function writeInt32($value)
    {
        $bytes = pack('l', $value);

        fwrite($this->handle, $bytes);
    }

    public function writeInt32BE($value)
    {
        $this->writeUInt32BE($value);
    }

    public function writeInt32LE($value)
    {
        $this->writeUInt32LE($value);
    }

    public function writeInt8($value)
    {
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
        $bytes = pack('S', $value);

        fwrite($this->handle, $bytes);
    }

    public function writeUInt16BE($value)
    {
        $bytes = pack('n', $value);

        fwrite($this->handle, $bytes);
    }

    public function writeUInt16LE($value)
    {
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
        $this->writeInt8($value);
    }

    public function writeUInt8BE($value)
    {
        $this->writeInt8BE($value);
    }

    public function writeUInt8LE($value)
    {
        $this->writeInt8LE($value);
    }
}
