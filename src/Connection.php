<?php
namespace Rizqon\GoogleScrapper;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Psr7;

class Connection
{
    public $timeout = 10.0;

    public $retry = 5;

    public $referer = 'https://google.com';

    public $proxy;

    public $useragent;

    public $url;

    public function __construct(array $args = [])
    {
        if(!empty($args['url'])){
            $this->url = $args['url'];
        }

        if(!empty($args['proxy'])){
            $this->proxy = $args['proxy'];        
        }
        
        if(!empty($args['useragent'])){
            $this->useragent = $args['useragent'];
        }
    }

    public function timeout(int $timeout)
    {
        $this->timeout = $timeout;

        return $this;
    }

    public function get(string $url = null, int $retry = 0)
    {
        $context = [
            'timeout' => $this->timeout,
            'headers' => [
                'Referer' => $this->referer;
            ];
        ];

        if(!is_null($url)){
            $this->url = $url;
        }

        if(!is_null($this->proxy)){
            $context[] = ['proxy' => $this->proxy];
        }

        if(!is_null($this->useragent)){
            $context['headers'][] = ['User-Agent' => $this->useragent];
        }

        $client = new Client($context);

        try{
            $response = $client->request('GET', $this->url);

            return (string) $response->getBody();
        }catch (TransferException $e){

            if($retry > $this->retry){
                return false;
            }

            return $this->get($url, $retry + 1);
        }
    }
}