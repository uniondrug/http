<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2018
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace Uniondrug\Http;

use RuntimeException;

/**
 * Class HttpException
 *
 * @package Uniondrug\Http\Exception
 */
class HttpException extends RuntimeException
{
    /**
     * @var int
     */
    protected $statusCode;

    /**
     * HttpException constructor.
     *
     * @param string $message
     * @param int    $statusCode
     */
    public function __construct($message = "Server Interval Error", $statusCode = 500)
    {
        parent::__construct($message);

        $this->statusCode = $statusCode;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
}