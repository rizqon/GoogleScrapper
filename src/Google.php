<?php
namespace Rizqon\GoogleScrapper;

use Rizqon\GoogleScrapper\Connection;
use KubAT\PhpSimple\HtmlDomParser;

class Google extends Connection
{

    private $keyword

    public function __construct()
    {
        parent::__construct();
    }

    public function image(string $keyword = null)
    {
        if(!is_null($keyword)){
            $this->keyword = $keyword;
        }

        $this->query = [
            'q' => urlencode($this->keyword),
	        'tbm' => 'isch',
	        'safe' => 'on',
	        'ijn' => 0,
            'gl' => 'us',
        ];

        $this->url = 'https://www.google.com/search';

        return $this->get();
    }
}