<?php

namespace Inani\OxfordApiWrapper\Exceptions;

use Exception;

class TranslateException extends Exception
{
    protected $messages = [
        400 => 'Target language must be set',
        404 => 'no entry is found matching supplied source language and word, and/or that entry has no senses with translations in the target language(s)',
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