<?php


namespace Classes;


class Config
{
    private $protocol = "http";
    private $address = "example.com";
    private $methods = [
        "getAll" => [
            "command" => "comments",
        ],
        "add" => [
            "command" => "comments",
        ],
        "update" => [
            "command" => "comment",
            "params" => ["id"],
        ],
        "getById" => [
            "command" => "comment",
            "params" => ["id"],
        ]
    ];

    public function getUrl($method, $params = false): string
    {
        $url = $this->protocol . "://" .
            $this->address . "/" .
            $this->methods[$method]["command"];
        if (is_array($params) && count($params) == count($this->methods[$method]["params"])) {
            $url .= "/" . implode("/", $params);
        }
        return $url;
    }
}
