<?php

class Route
{
    protected string $method = 'GET';
    protected string $uri = '';
    protected string $to = '';
    protected bool $spoof = true;

    public function get($uri, $to): void
    {
        $this->method = 'GET';
        $this->uri = $uri;
        $this->to = $to;
        $this->check();
    }

    public function post($uri, $to): void
    {
        $this->method = 'POST';
        $this->uri = $uri;
        $this->to = $to;
        $this->check();
    }

    public function delete($uri, $to): void
    {
        $this->method = 'POST';
        $this->spoof = strtoupper($_POST['_method'] ?? '') == 'DELETE';
        $this->uri = $uri;
        $this->to = $to;
        $this->check();
    }

    public function put($uri, $to): void
    {
        $this->method = 'POST';
        $this->spoof = strtoupper($_POST['_method'] ?? '') == 'PUT';
        $this->uri = $uri;
        $this->to = $to;
        $this->check();
    }

    public function patch($uri, $to): void
    {
        $this->method = 'POST';
        $this->spoof = strtoupper($_POST['_method'] ?? '') == 'PATCH';
        $this->uri = $uri;
        $this->to = $to;
        $this->check();
    }

    public function resource($name): void
    {
        $this->get("$name", "controllers/$name/index.php");
        $this->get("$name/create", "controllers/$name/create.php");
        $this->post("$name", "controllers/$name/store.php");
        $this->get("$name/{id}", "controllers/$name/show.php");
        $this->get("$name/{id}/edit", "controllers/$name/edit.php");
        $this->put("$name/{id}", "controllers/$name/update.php");
        $this->delete("$name/{id}", "controllers/$name/destroy.php");
    }


    private function check(): void
    {
        if ($this->method == $_SERVER["REQUEST_METHOD"] and
            $this->checkUri() and
            $this->spoof) {
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/../app/" . $this->to)) {
                require $_SERVER['DOCUMENT_ROOT'] . "/../app/" . $this->to;
            } else {
                //pagina bestaat niet
                http_response_code(404);
                require file_exists(__DIR__ . '/../app/views/404.view.php') ?
                    __DIR__ . '/../app/views/404.view.php' :
                    __DIR__ . '/../src/views/404.view.php';
            }
            die();
        }
    }

    private function checkUri(): bool
    {

        preg_match("/^" . preg_replace('#\/#', '\\/', preg_replace('/{(.*?)}/', '([0-9]+)', $this->uri)) . "$/", trim(parse_url($_SERVER['REQUEST_URI'])['path'], "/"), $matches);
        if (!empty($matches)) {
            if (count($matches) > 1) {
                $value = $matches[1];
                preg_match('/{(.*?)}/', $this->uri, $matches);
                if ($this->method == 'GET') {
                    $_GET[$matches[1]] = $value;
                } else {
                    $_POST[$matches[1]] = $value;
                }
            }
            return true;
        }
        return false;

    }
}