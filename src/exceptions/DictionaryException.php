<?php

namespace Inani\OxfordApiWrapper\Exceptions;

use Exception;

class DictionaryException extends Exception
{
    protected $messages = [
        404 => 'No entry is found matching supplied id and source language or filters are not recognized',
        500 => 'Internal Error. An error occurred while processing the data.'
    ];

    /**
     * Constructor
     *
     * @param string $code
     */
    public function __construct($code)
    {
        parent::__construct($this->messages[$code]);
    }
}