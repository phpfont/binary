<?php

namespace PhpFont\Binary;

interface StreamInterface
{
    /** Little-endian byte order (0x04 0x03 0x02 0x01). */
    const BYTE_ORDER_LITTLE_ENDIAN = 0;

    /** Big-endian byte order (0x01 0x02 0x03 0x04). */
    const BYTE_ORDER_BIG_ENDIAN = 1;

    /**
     * Gets the endianness of the current machine.
     *
     * @return int
     */
    public function getEndianness();

    /**
     * Gets the size of the stream.
     *
     * @return int
     */
    public function getSize();

    /**
     * Gets the size of the stream.
     *
     * @return int
     */
    public function getPosition();

    /**
     * Sets the position within the stream.
     *
     * @param int $position The position to set.
     */
    public function setPosition($position);

    /**
     * Reads a 32-bits floating point number in machine byte order.
     *
     * @return float
     */
    public function readFloat32();

    /**
     * Reads a 32-bits floating point number in big endian byte order.
     *
     * @return float
     */
    public function readFloat32BE();

    /**
     * Reads a 32-bits floating point number in little endian byte order.
     *
     * @return float
     */
    public function readFloat32LE();

    /**
     * Reads a 64-bits floating point number in machine byte order.
     *
     * @return float
     */
    public function readFloat64();

    /**
     * Reads a 64-bits floating point number in big endian byte order.
     *
     * @return float
     */
    public function readFloat64BE();

    /**
     * Reads a 64-bits floating point number in little endian byte order.
     *
     * @return float
     */
    public function readFloat64LE();

    /**
     * Reads an 8-bit integer in machine byte order.
     *
     * @return int
     */
    public function readInt8();

    /**
     * Reads an 8-bit integer in big endian byte order.
     *
     * @return int
     */
    public function readInt8BE();

    /**
     * Reads an 8-bit integer in little endian byte order.
     *
     * @return int
     */
    public function readInt8LE();

    /**
     * Reads an 16-bit integer in machine byte order.
     *
     * @return int
     */
    public function readInt16();

    /**
     * Reads an 16-bit integer in big endian byte order.
     *
     * @return int
     */
    public function readInt16BE();

    /**
     * Reads an 16-bit integer in little endian byte order.
     *
     * @return int
     */
    public function readInt16LE();

    /**
     * Reads an 32-bit integer in machine byte order.
     *
     * @return int
     */
    public function readInt32();

    /**
     * Reads an 32-bit integer in big endian byte order.
     *
     * @return int
     */
    public function readInt32BE();

    /**
     * Reads an 32-bit integer in little endian byte order.
     *
     * @return int
     */
    public function readInt32LE();

    /**
     * Reads a string.
     *
     * @param int $length The length of the string to read.
     * @return string
     */
    public function readString($length);

    /**
     * Reads an 8-bit unsigned integer in machine byte order.
     *
     * @return int
     */
    public function readUInt8();

    /**
     * Reads an 8-bit unsigned integer in big endian byte order.
     *
     * @return int
     */
    public function readUInt8BE();

    /**
     * Reads an 8-bit unsigned integer in little endian byte order.
     *
     * @return int
     */
    public function readUInt8LE();

    /**
     * Reads an 16-bit unsigned integer in machine byte order.
     *
     * @return int
     */
    public function readUInt16();

    /**
     * Reads an 16-bit unsigned integer in big endian byte order.
     *
     * @return int
     */
    public function readUInt16BE();

    /**
     * Reads an 16-bit unsigned integer in little endian byte order.
     *
     * @return int
     */
    public function readUInt16LE();

    /**
     * Reads an 32-bit unsigned integer in machine byte order.
     *
     * @return int
     */
    public function readUInt32();

    /**
     * Reads an 32-bit unsigned integer in big endian byte order.
     *
     * @return int
     */
    public function readUInt32BE();

    /**
     * Reads an 32-bit unsigned integer in little endian byte order.
     *
     * @return int
     */
    public function readUInt32LE();

    /**
     * Writes a 32-bits floating point number in machine byte order.
     *
     * @param float $value The value to write.
     */
    public function writeFloat32($value);

    /**
     * Writes a 32-bits floating point number in big endian byte order.
     *
     * @param float $value The value to write.
     */
    public function writeFloat32BE($value);

    /**
     * Writes a 32-bits floating point number in little endian byte order.
     *
     * @param float The value to write.
     */
    public function writeFloat32LE($value);

    /**
     * Writes a 64-bits floating point number in machine byte order.
     *
     * @param float $value The value to write.
     */
    public function writeFloat64($value);

    /**
     * Writes a 64-bits floating point number in big endian byte order.
     *
     * @param float $value The value to write.
     */
    public function writeFloat64BE($value);

    /**
     * Writes an 64-bits floating point number in little endian byte order.
     *
     * @param float The value to write.
     */
    public function writeFloat64LE($value);

    /**
     * Writes an 8-bit integer in machine byte order.
     *
     * @param int $value The value to write.
     */
    public function writeInt8($value);

    /**
     * Writes an 8-bit integer in big endian byte order.
     *
     * @param int $value The value to write.
     */
    public function writeInt8BE($value);

    /**
     * Writes an 8-bit integer in little endian byte order.
     *
     * @param int $value The value to write.
     */
    public function writeInt8LE($value);

    /**
     * Writes an 16-bit integer in machine byte order.
     *
     * @param int $value The value to write.
     */
    public function writeInt16($value);

    /**
     * Writes an 16-bit integer in big endian byte order.
     *
     * @param int $value The value to write.
     */
    public function writeInt16BE($value);

    /**
     * Writes an 16-bit integer in little endian byte order.
     *
     * @param int $value The value to write.
     */
    public function writeInt16LE($value);

    /**
     * Writes an 32-bit integer in machine byte order.
     *
     * @param int $value The value to write.
     */
    public function writeInt32($value);

    /**
     * Writes an 32-bit integer in big endian byte order.
     *
     * @param int $value The value to write.
     */
    public function writeInt32BE($value);

    /**
     * Writes an 32-bit integer in little endian byte order.
     *
     * @param int $value The value to write.
     */
    public function writeInt32LE($value);

    /**
     * Writes a string.
     *
     * @param string $value The value to write.
     */
    public function writeString($value);

    /**
     * Writes an 8-bit unsigned integer in machine byte order.
     *
     * @param int $value The value to write.
     */
    public function writeUInt8($value);

    /**
     * Writes an 8-bit unsigned integer in big endian byte order.
     *
     * @param int $value The value to write.
     */
    public function writeUInt8BE($value);

    /**
     * Writes an 8-bit unsigned integer in little endian byte order.
     *
     * @param int $value The value to write.
     */
    public function writeUInt8LE($value);

    /**
     * Writes an 16-bit unsigned integer in machine byte order.
     *
     * @param int $value The value to write.
     */
    public function writeUInt16($value);

    /**
     * Writes an 16-bit unsigned integer in big endian byte order.
     *
     * @param int $value The value to write.
     */
    public function writeUInt16BE($value);

    /**
     * Writes an 16-bit unsigned integer in little endian byte order.
     *
     * @param int $value The value to write.
     */
    public function writeUInt16LE($value);

    /**
     * Writes an 32-bit unsigned integer in machine byte order.
     *
     * @param int $value The value to write.
     */
    public function writeUInt32($value);

    /**
     * Writes an 32-bit unsigned integer in big endian byte order.
     *
     * @param int $value The value to write.
     */
    public function writeUInt32BE($value);

    /**
     * Writes an 32-bit unsigned integer in little endian byte order.
     *
     * @param int $value The value to write.
     */
    public function writeUInt32LE($value);
}
