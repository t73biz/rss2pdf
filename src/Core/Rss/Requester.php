<?php
/**
 * RSS Requester
 *
 * Copyright 2015
 * Ronald Chaplin
 * rchaplin@t73.biz
 */
namespace Core\Rss;

use Core\Exception\InvalidRequestException;

/**
 * Class Requester
 * @package Core\Rss
 */
class Requester
{
    /**
     * @var resource
     */
    protected $curl;

    /**
     * @param string $url
     */
    public function __construct($url)
    {
        $this->curl = curl_init();
        curl_setopt_array($this->curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url
        ));
    }

    /**
     * @return mixed
     * @throws InvalidRequestException
     */
    public function getFeed()
    {
        $result = curl_exec($this->curl);
        curl_close($this->curl);

        if (!$result) {
            throw new InvalidRequestException("Invalid url request " . curl_error($this->curl) . '" - Code: ' . curl_errno($this->curl));
        }

        return $result;
    }
}
