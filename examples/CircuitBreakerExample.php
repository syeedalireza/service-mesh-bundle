<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Syeedalireza\ServiceMeshBundle\Resilience\CircuitBreaker;
use Syeedalireza\ServiceMeshBundle\Resilience\RetryPolicy;

echo "=== Service Mesh Example ===\n\n";

// Circuit Breaker
$cb = new CircuitBreaker(threshold: 3);

echo "1. Circuit Breaker:\n";
try {
    $result = $cb->call(function() {
        return "Service call successful!";
    });
    echo "   ✓ $result\n";
} catch (\Exception $e) {
    echo "   ✗ Failed\n";
}

// Retry Policy
echo "\n2. Retry Policy:\n";
$retry = new RetryPolicy(maxAttempts: 3);
$attempt = 0;

$result = $retry->execute(function() use (&$attempt) {
    $attempt++;
    if ($attempt < 2) {
        throw new \RuntimeException("Attempt $attempt failed");
    }
    return "Success on attempt $attempt";
});

echo "   $result\n";
echo "\n✅ Service Mesh patterns work!\n";
