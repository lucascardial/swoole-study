<?php

namespace Core\Container;
use ReflectionException;
use ReflectionParameter;

class ParametersResolver
{
    public function __construct(
        protected ContainerInterface $container,
        protected array $parameters,
        protected array $args = []
    ) {
    }

    public function getArguments(): array
    {
        return array_map( function (ReflectionParameter $param) {
                if (array_key_exists($param->getName(), $this->args)) {
                    return $this->args[$param->getName()];
                }

                return $param->getType() && !$param->getType()->isBuiltin()
                    ? $this->getClassInstance($param->getType()->getName())
                    : $param->getDefaultValue();
            },
            $this->parameters
        );
    }

    protected function getClassInstance(string $namespace): object
    {
        $instance = $this->container->resolve($namespace);

        return $instance;
//        return (new ClassResolver($this->container, $namespace))->getInstance();
    }
}