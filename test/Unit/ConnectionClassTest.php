<?php

use PHPUnit\Framework\TestCase;
use Rizqon\GoogleScrapper\Connection;

class ConnectionClassTest extends TestCase
{
    /** @test */
    public function open_connection_with_style_one()
    {
        $connection = new Connection;
        $result = $connection->get('https://google.com');

        $this->assertIsString($result);
    }

    /** @test */
    public function open_connection_with_style_two()
    {
        $connection = new Connection(
            [
                'url' => 'https://google.com'
            ]
        );
        $result = $connection->get();

        $this->assertIsString($result);
    }

    /** @test */
    public function open_connection_with_style_two_with_arguments()
    {
        $connection = new Connection(
            [
                'url' => 'https://google.com',
                'proxy' => 'http://rasaf:rasafamily@au.torguardvpnaccess.com:6060',
                'useragent' => 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36'
            ]
        );
        $result = $connection->get();

        $this->assertIsString($result);
    }

    /** @test */
    public function open_connection_with_style_three()
    {
        $connection = new connection;
        $connection->url = 'https://google.com';
        $result = $connection->get();

        $this->assertIsString($result);
    }

    /** @test */
    public function open_connection_with_style_three_with_arguments()
    {
        $connection = new connection;
        $connection->url = 'https://google.com';
        $connection->proxy = 'http://rasaf:rasafamily@au.torguardvpnaccess.com:6060';
        $connection->useragent = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36';
        $result = $connection->get();

        $this->assertIsString($result);
    }

    /** @test */
    public function open_connection_with_style_four()
    {
        $connection = new connection;
        $result = $connection->url('https://google.com')->get();

        $this->assertIsString($result);
    }

    /** @test */
    public function open_connection_with_style_four_with_arguments()
    {
        $connection = new connection;
        $result = $connection->url('https://google.com')
                            ->proxy('http://rasaf:rasafamily@au.torguardvpnaccess.com:6060')
                            ->useragent('Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36')
                            ->get();

        $this->assertIsString($result);
    }
}