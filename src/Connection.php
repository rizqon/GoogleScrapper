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

    public $query;

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

    public function proxy(string $proxy)
    {
        $this->proxy = $proxy;

        return $this;
    }

    public function useragent(string $useragent)
    {
        $this->useragent = $useragent;

        return $this;
    }

    public function retry(int $retry)
    {
        $this->retry = $retry;

        return $this;
    }

    public function referer(string $referer)
    {
        $this->referer = $referer;

        return $this;
    }

    public function url(string $url)
    {
        $this->url = $url;

        return $this;
    }

    public function query(string $query)
    {
        $this->query = $query;

        return $this;
    }

    public function get(string $url = null, array $query = [],int $retry = 0)
    {
        $options = [
            'timeout' => $this->timeout,
            'headers' => [
                'Referer' => $this->referer
            ]
        ];

        if(!empty($query)){
            $this->query = $query;
        }

        if(!is_null($url)){
            $this->url = $url;
        }

        if(!is_null($this->proxy)){
            $options = array_merge($options, ['proxy' => $this->proxy]);
        }

        if(!is_null($query)){
            $options = array_merge($options, [ 'query' => $this->query]);
        }

        if(!is_null($this->useragent)){
            $options = array_merge_recursive( $options, [ 'headers' => [ 'User-Agent' => $this->useragent] ] );
        }

        $client = new Client($options);

        try{
            $response = $client->request('GET', $this->url);

            return (string) $response->getBody();
        }catch (TransferException $e){

            if($retry > $this->retry){
                throw $e;
            }
            return $this->get($url, $retry + 1);
        }
    }
}