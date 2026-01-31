# Load Balancing

## Strategies

### Round Robin

Distributes requests evenly across all nodes:

```php
use Syeedalireza\ServiceMeshBundle\LoadBalancer\RoundRobinBalancer;

$balancer = new RoundRobinBalancer(['node1:50051', 'node2:50051', 'node3:50051']);

$node = $balancer->getNext(); // node1
$node = $balancer->getNext(); // node2
$node = $balancer->getNext(); // node3
$node = $balancer->getNext(); // node1 (cycles)
```

## Integration with Service Discovery

```php
$services = $registry->discover('user-service');
$balancer = new RoundRobinBalancer($services);

foreach ($requests as $request) {
    $node = $balancer->getNext();
    $grpcClient->call($node, $request);
}
```

## Configuration

```yaml
service_mesh:
    load_balancing:
        strategy: round_robin
        health_check_interval: 30
```
