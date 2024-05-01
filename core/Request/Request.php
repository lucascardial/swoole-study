<?php

namespace Core\Request;

readonly class Request
{
    public function __construct(
        private array $params = [],
        private array $data = [],
    )
    {
    }

    public static function fromSwooleRequest(\Swoole\Http\Request $request): self
    {
        $query = $request->get ?? [];
        $body = json_decode($request->rawContent(), true);
        $data = array_merge($query, $body ?? []);

        return new self($query, $data);
    }

    public function param(string $key, mixed $default = null): mixed
    {
        return $this->params[$key] ?? $default;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->data[$key] ?? $default;
    }

    public function all(): array
    {
        return $this->data;
    }
}