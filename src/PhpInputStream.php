<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2018
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace Uniondrug\Http;

/**
 * Class PhpInputStream
 *
 * @package Uniondrug\Http
 */
class PhpInputStream extends Stream
{
    /**
     * @var string
     */
    private $cache = '';

    /**
     * @var bool
     */
    private $reachedEof = false;

    /**
     * PhpInputStream constructor.
     *
     * @param string $stream
     * @param string $mode
     */
    public function __construct($stream = 'php://input', $mode = 'r')
    {
        parent::__construct($stream, $mode);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        if ($this->reachedEof) {
            return $this->cache;
        }

        $this->rewind();
        $this->getContents();

        return $this->cache;
    }

    /**
     * @return bool false
     */
    public function isWritable()
    {
        return false;
    }

    /**
     * @param int $length
     *
     * @return string
     */
    public function read($length)
    {
        $content = parent::read($length);
        if ($content && !$this->reachedEof) {
            $this->cache .= $content;
        }

        if ($this->eof()) {
            $this->reachedEof = true;
        }

        return $content;
    }

    /**
     * @param int $maxLength
     *
     * @return string
     */
    public function getContents($maxLength = -1)
    {
        if ($this->reachedEof) {
            return $this->cache;
        }

        $contents = stream_get_contents($this->resource, $maxLength);
        $this->cache .= $contents;

        if ($maxLength === -1 || $this->eof()) {
            $this->reachedEof = true;
        }

        return $contents;
    }
}