<?php

namespace App;

class Request
{

    private $postData = [];
    private $getData = [];
    private $requestMethod;

    function __construct()
    {
        $this->requestMethod = getenv('REQUEST_METHOD');
        $this->getData = $_GET;
        $this->postData = $_POST;
    }

    public function getRequestData()
    {
        return $this->requestMethod;
    }

    public function getGetData()
    {
        return $this->getData;
    }

    public function getPostData()
    {
        return $this->postData;
    }
}
