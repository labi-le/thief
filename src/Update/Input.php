<?php

declare(strict_types=1);

namespace labile\thief\Update;

use Psr\Http\Message\StreamInterface;
use RuntimeException;

class Input implements StreamInterface
{
    protected mixed $stream;
    protected int $size = 0;

    public function __construct()
    {
        $this->stream = fopen('php://input', 'r');
    }

    public function __toString(): string
    {
        $this->rewind();
        return stream_get_contents($this->stream);
    }

    public function close(): void
    {
        fclose($this->stream);
    }

    public function detach()
    {
        $result = $this->stream;
        $this->stream = null;
        $this->size = 0;
        return $result;
    }

    public function getSize(): ?int
    {
        if ($this->size === 0 && $this->stream) {
            $stats = fstat($this->stream);
            $this->size = $stats['size'] ?? null;
        }
        return $this->size;
    }

    public function tell(): int
    {
        return ftell($this->stream);
    }

    public function eof(): bool
    {
        return feof($this->stream);
    }

    public function isSeekable(): bool
    {
        $meta = stream_get_meta_data($this->stream);
        return $meta['seekable'];
    }

    public function seek(int $offset, int $whence = SEEK_SET): void
    {
        if (!$this->isSeekable()) {
            throw new RuntimeException('Stream is not seekable');
        }
        fseek($this->stream, $offset, $whence);
    }

    public function rewind(): void
    {
        $this->seek(0);
    }

    public function isWritable(): bool
    {
        return false;
    }

    public function write(string $string): int
    {
        throw new RuntimeException('Cannot write to a read-only stream');
    }

    public function isReadable(): bool
    {
        return true;
    }

    public function read(int $length): string
    {
        return fread($this->stream, $length);
    }

    public function getContents(): string
    {
        return stream_get_contents($this->stream);
    }

    public function getMetadata(?string $key = null)
    {
        $meta = stream_get_meta_data($this->stream);
        if ($key === null) {
            return $meta;
        }
        return $meta[$key] ?? null;
    }

}