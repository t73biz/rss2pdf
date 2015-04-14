<?php
/**
 * Invalid Input Exception
 *
 * Copyright 2015
 * Ronald Chaplin
 * rchaplin@t73.biz
 */
namespace Core\Rss;

use Core\Model\Feed;

/**
 * Class Validator
 * @package Core\Rss
 */
class Validator
{
    /**
     * @var bool
     */
    protected $valid = false;

    /**
     * @param Feed $feed
     */
    public function __construct(Feed $feed)
    {
        $rss = $feed->getRss();
        if (isset($rss->channel->item)) {
            $this->valid = true;
        }
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return $this->valid;
    }
}
