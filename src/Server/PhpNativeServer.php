<?php

namespace Lune\Server;

use Lune\Http\HttpMethod;
use Lune\Http\Response;

class PhpNativeServer implements Server {
    public function requestUri(): string {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    public function requestMethod(): HttpMethod {
        return HttpMethod::from($_SERVER['REQUEST_METHOD']);
    }

    public function postData(): array {
        return $_POST;
    }

    public function queryParams(): array {
        return $_GET;
    }

    public function sendResponse(Response $response) {
        $response->prepare();
        http_response_code($response->status());
        foreach ($response->headers() as $header => $value) {
            header("$header: $value");
        }
        print($response->content());
    }
}
