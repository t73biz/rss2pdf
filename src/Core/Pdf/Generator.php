<?php
/**
 * PDF Generator
 *
 * Copyright 2015
 * Ronald Chaplin
 * rchaplin@t73.biz
 */
namespace Core\Pdf;

use Core\Model\Feed;

/**
 * Class Generator
 * @package Core\Pdf
 */
class Generator
{
    /**
     * @var Feed
     */
    protected $feed;

    /**
     * @var \XMLWriter
     */
    protected $xml;

    /**
     * @param Feed $feed
     */
    public function __construct(Feed $feed)
    {
        $this->xml = new \XMLWriter();
        $this->xml->openMemory();
        $this->xml->setIndent(true);

        $this->feed = $feed;
    }

    public function createPdf()
    {
        $rss = $this->feed->getRss();
        $pdfModel = new \stdClass;
        for($count = 1; $count <= 5; $count++) {
            $description = (string)$rss->channel->item[$count]->description;
            $pdfModel->page[$count] = $this->cleanSource($description);
        }
        return html_entity_decode($this->generatePdf($pdfModel));
    }

    private function cleanSource($html)
    {
        $doc = new \DOMDocument();
        $doc->recover = true;
        $doc->strictErrorChecking = false;
        $doc->formatOutput = true;
        @$doc->loadHTML($html);
        return preg_replace('~<(?:!DOCTYPE|/?(?:html|head|body|img|link|script|nobr))[^>]*>\s*~i', '', $doc->saveHTML());
    }

    private function startsWith($haystack, $needle)
    {
        return !strncmp($haystack, $needle, strlen($needle));
    }

    private function generatePdf($model)
    {
        $this->transModel2Xml($model);

        $this->xml->endElement();

        return $this->xml->outputMemory(true);
    }

    private function transModel2Xml($model)
    {
        foreach($model as $key => $value) {
            if(is_object($value)) {
                $this->xml->startElement($key);
                $this->transModel2Xml($value);
                $this->xml->endElement();
                continue;
            } else if(is_array($value)) {
                $this->transArray2XML($key, $value);
            }

            if (is_string($value)) {
                $this->xml->writeElement($key, $value);
            }
        }
    }

    private function transArray2Xml($parent, $data)
    {
        foreach($data as $key => $value) {
            if (is_string($value)) {
                $this->xml->writeElement($parent, $value);
                continue;
            }

            if (is_numeric($key)) {
                $this->xml->startElement($parent);
            }

            if(is_object($value)) {
                $this->transModel2Xml($value);
            }
            else if(is_array($value)) {
                $this->transArray2Xml($key, $value);
                continue;
            }

            if (is_numeric($key)) {
                $this->xml->endElement();
            }
        }
    }
}
