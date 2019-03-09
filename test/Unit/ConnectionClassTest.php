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
    public function open_connection_with_style_three()
    {
        $connection = new connection;
        $connection->url = 'https://google.com';
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
}