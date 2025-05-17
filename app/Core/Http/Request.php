<?php

namespace App\Core\Http;

use App\Core\Container\Container;
use App\Core\Session\Session;
use App\Core\Validator\Validator;

class Request
{
    private Validator $validator;
    public Session $session;

    public readonly array $server;
    public readonly array $get;
    public readonly array $post;
    public readonly array $files;
    public readonly array $cookie;

    public function __construct(Validator $validator, Session $session)
    {
        $this->createFromGlobals();
        $this->validator = $validator;
        $this->session = $session;
    }

    public function createFromGlobals()
    {
        $this->server = $_SERVER;
        $this->get = $_GET;
        $this->post = $_POST;
        $this->files = $_FILES;
        $this->cookie = $_COOKIE;
    }

    public function uri(): string
    {
        return parse_url($this->server['REQUEST_URI'], PHP_URL_PATH);
    }

    public function method(): string
    {
        return strtoupper($this->server['REQUEST_METHOD']);
    }

    public function input(string $key, $default = null)
    {
        return $this->post[$key] ?? $this->get[$key] ?? $default;
    }

    public function validate(array $rules) : bool
    {
        return $this->validator->validate($this->post, $rules);
    }

    public function validated(): array
    {
        return $this->validator->validated();
    }

    public function errors() : array
    {
        return $this->validator->errors();
    }

    public function redirect(string $to)
    {
        header('Location: ' . $to);
    }

}