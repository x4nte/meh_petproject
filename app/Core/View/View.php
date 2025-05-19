<?php

namespace App\Core\View;

use App\Core\Session\Session;

class View
{

    public function __construct(public Session $session)
    {
    }

    public function view(string $name, array $data = []): void
    {
        $path = APP_PATH . "views/$name.php";
        if (!file_exists($path)) {
            throw new \Exception("View $name does not exist");
        }
        extract($data);
        $view = $this;
        $errors = $this->session->getFlash('errors');
        $formData = $this->session->getFlash('formData');
        require $path;
    }


    public function component(string $name): void
    {
        $path = APP_PATH . "views/components/$name.php";
        if (!file_exists($path)) {
            echo " <p class='text-red-500 text-xs font-semibold'>Component $name not found </p>";
            return;
        }
        $view = $this;
        require $path;
    }
}