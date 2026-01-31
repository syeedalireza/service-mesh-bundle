<?php

declare(strict_types=1);

namespace Syeedalireza\ServiceMeshBundle\Exception;

final class ServiceUnavailableException extends \RuntimeException
{
    public static function forService(string $serviceName): self
    {
        return new self("Service '{$serviceName}' is unavailable");
    }
}
