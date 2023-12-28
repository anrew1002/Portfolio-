<?php

namespace App;

class View
{
    protected $templatesPath = "templates/";

    public function __construct()
    {
        //
    }

    public function render(string $template, array $data = [])
    {
        extract($data);
        include $this->templatesPath . $template . ".php";
    }
}
