<?php
ini_set("display_errors", 1);
require("vendor/autoload.php");

use Core\Form\Validator as FormValidator;
use Core\Model\Feed;
use Core\Pdf\Generator;
use Core\Rss\Requester;
use Core\Rss\Validator as RssValidator;

if($_POST) {
    try {
        $formValidator = new FormValidator();
        $requester = new Requester($formValidator->getUrl());
        $feed = new Feed($requester->getFeed());
        $rssValidator = new RssValidator($feed);
        if($rssValidator->isValid()) {
            $generator = new Generator($feed);
            $pdf = $generator->createPdf();
            $html2pdf = new HTML2PDF('P', 'A4', 'en');
            $html2pdf->writeHTML($pdf);
            $html2pdf->Output('Rss.pdf', 'D');
        } else {
            ob_start();
            include(dirname(__FILE__).'/src/form.php');
            $content = ob_get_clean();
            echo $content;
        }
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
} else {
    ob_start();
    include(dirname(__FILE__).'/src/form.php');
    $content = ob_get_clean();
    echo $content;
}

