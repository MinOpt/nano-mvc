<?php
namespace App\Http;

class Response
{
    private string $content;
    private int $status;
    private array $headers = [];

    public function __construct(string $content = '', int $status = 200) {
        $this->content = $content;
        $this->status = $status;
    }

    public static function html(string $html, int $status = 200): self {
        return (new self($html, $status))->withHeader('Content-Type', 'text/html; charset=utf-8');
    }

    public function withHeader(string $name, string $value): self {
        $this->headers[$name] = $value;
        return $this;
    }

    public function send(): void {
        http_response_code($this->status);
        foreach ($this->headers as $name => $value) header("$name: $value");
        echo $this->content;
    }
}