<?php

namespace Lune;

class Request
{
    protected $uri;

    protected HttpMethod $method;

    protected array $data;

    protected array $query;
    
    public function __construct(Server $server) {
        $this->uri = $server->requestUri();
        $this->method = $server->requestMethod();
        $this->data = $server->postData();
        $this->query = $server->queryParams();
    }

    public function uri()
    {
        return $this->uri;
    }

    public function method()
    {
        return $this->method;
    }

}