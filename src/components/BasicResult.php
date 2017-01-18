<?php
namespace Inani\OxfordApiWrapper\Components;


abstract class BasicResult
{
    protected $result;

    public function __construct(array $result)
    {
        $this->result = $result;
    }

    abstract public function get();
}