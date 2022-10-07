<?php

namespace Lune\Server;

use Lune\Http\HttpMethod;
use Lune\Http\Request;
use Lune\Http\Response;

class PhpNativeServer implements Server {
    /**
     * @inheritDoc
     */
    public function getRequest(): Request {
        return (new Request())
            ->setUri(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))
            ->setMethod(HttpMethod::from($_SERVER['REQUEST_METHOD']))
            ->setPostData($_POST)
            ->setQueryParameters($_GET);
    }

    /**
     * @inheritDoc
     */
    public function sendResponse(Response $response) {
        $response->prepare();
        http_response_code($response->status());
        foreach ($response->headers() as $header => $value) {
            header("$header: $value");
        }
        print($response->content());
    }
}
