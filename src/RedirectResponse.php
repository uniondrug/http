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
 * Class RedirectResponse
 *
 * @package Uniondrug\Http
 */
class RedirectResponse extends Response
{
    /**
     * RedirectResponse constructor.
     *
     * @param string $uri
     * @param int    $status
     * @param array  $headers
     */
    public function __construct($uri, $status = 302, array $headers = [])
    {
        parent::__construct('', $status, $headers);

        $this->withLocation($uri);
    }
}