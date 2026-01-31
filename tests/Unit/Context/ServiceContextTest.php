<?php

declare(strict_types=1);

namespace Syeedalireza\ServiceMeshBundle\Tests\Unit\Context;

use PHPUnit\Framework\TestCase;
use Syeedalireza\ServiceMeshBundle\Context\ServiceContext;

final class ServiceContextTest extends TestCase
{
    public function testSetAndGetService(): void
    {
        $context = new ServiceContext();
        $context->setCurrentService('user-service');

        $this->assertEquals('user-service', $context->getCurrentService());
    }

    public function testMetadata(): void
    {
        $context = new ServiceContext();
        $context->setMetadata('version', '1.0.0');

        $this->assertEquals('1.0.0', $context->getMetadata('version'));
    }
}
