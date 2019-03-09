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

        $this->assertIsArray($result);
    }
}