<?php

declare(strict_types=1);

namespace Syeedalireza\ServiceMeshBundle\Tests\Unit\Grpc;

use PHPUnit\Framework\TestCase;
use Syeedalireza\ServiceMeshBundle\Grpc\GrpcServer;

final class GrpcServerTest extends TestCase
{
    public function testServerCreation(): void
    {
        $server = new GrpcServer(50051);

        $this->assertEquals(50051, $server->getPort());
    }

    public function testRegisterHandler(): void
    {
        $server = new GrpcServer();
        $server->registerHandler('UserService', fn() => 'handler');

        $this->assertCount(1, $server->getHandlers());
    }
}
