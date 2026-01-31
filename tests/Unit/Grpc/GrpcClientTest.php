<?php

declare(strict_types=1);

namespace Syeedalireza\ServiceMeshBundle\Tests\Unit\Grpc;

use PHPUnit\Framework\TestCase;
use Syeedalireza\ServiceMeshBundle\Grpc\GrpcClient;

final class GrpcClientTest extends TestCase
{
    public function testClientCreation(): void
    {
        $client = new GrpcClient('localhost', 50051);

        $this->assertEquals('localhost:50051', $client->getAddress());
    }

    public function testCall(): void
    {
        $client = new GrpcClient('localhost');
        
        $response = $client->call('UserService', 'GetUser', ['id' => 123]);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('response', $response);
    }
}
