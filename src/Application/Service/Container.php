<?php

declare(strict_types=1);

namespace Application\Service;

use Application\Exception\ServiceNotFoundException;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    private array $containerConfiguration = [
        'aliases' => [],
        'factories' => [],
        'invokables' => [],
    ];

    private array $implementations = [];

    public function __construct(array $config = null)
    {
        if (is_array($config)) {
            $this->addConfiguration($config);
        }
    }

    public function get(string $id)
    {
        if (!isset($this->implementations[$id])) {
            $this->implementations[$id] = $this->getImplementation($id);
        }
        return $this->implementations[$id];
    }

    public function has(string $id): bool
    {
        return isset($containerConfiguration['aliases'][$id]) ||
            isset($containerConfiguration['factories'][$id]) ||
            isset($containerConfiguration['invokables'][$id]);
    }

    public function set(string $id, object|array $target): void
    {
        $this->implementations[$id] = $target;
    }

    public function addConfiguration($config): void
    {
        foreach ($config as $type => $list) {
            foreach ($list as $id => $target) {
                $this->containerConfiguration[$type][$id] = $target;
            }
        }
    }

    private function getImplementation(string $id): object
    {
        if (isset($this->containerConfiguration['aliases'][$id])) {
            return $this->getImplementation($this->containerConfiguration['aliases'][$id]);
        }

        if (isset($this->containerConfiguration['invokables'][$id])) {
            $target = $this->containerConfiguration['invokables'][$id];
            return new $target();
        }

        if (isset($this->containerConfiguration['factories'][$id])) {
            $factoryClass = $this->containerConfiguration['factories'][$id];
            /** @var callable $factory */
            $factory = new $factoryClass();
            return $factory($this);
        }

        throw new ServiceNotFoundException('Missing service ' . $id);
    }
}
