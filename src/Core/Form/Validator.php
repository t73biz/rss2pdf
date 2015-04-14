<?php
/**
 * Form Validator
 *
 * Copyright 2015
 * Ronald Chaplin
 * rchaplin@t73.biz
 */
namespace Core\Form;

use Core\Exception\InvalidInputException;

/**
 * Class Validator
 * @package Core\Form
 */
class Validator
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @throws InvalidInputException
     */
    public function __construct()
    {
        if (!isset($_POST["url"])) {
            throw new InvalidInputException("The form did not have a url set.");
        } else {
            if (!filter_var($_POST['url'], FILTER_VALIDATE_URL) === false) {
                $this->url = $_POST['url'];
            } else {
                throw new InvalidInputException("The url supplied is not valid.");
            }
        }
    }

    public function getUrl()
    {
        return $this->url;
    }
}
