<?php

declare(strict_types=1);

namespace Syeedalireza\ServiceMeshBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

final class ServiceMeshBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
