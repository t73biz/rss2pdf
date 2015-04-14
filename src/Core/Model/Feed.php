<?php
/**
 * Feed Model
 *
 * Copyright 2015
 * Ronald Chaplin
 * rchaplin@t73.biz
 */
namespace Core\Model;

/**
 * Class Feed
 * @package Core\Model
 */
class Feed
{
    /**
     * @var \SimpleXMLElement
     */
    protected $rss;

    /**
     * @param string $feed
     */
    public function __construct($feed)
    {
        @$this->rss = new \SimpleXMLElement($feed);
    }

    /**
     * @return \SimpleXMLElement
     */
    public function getRss()
    {
        return $this->rss;
    }
}
