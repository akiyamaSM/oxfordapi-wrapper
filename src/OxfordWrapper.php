<?php

namespace Inani\OxfordApiWrapper;

use Inani\OxfordApiWrapper\Components\DefinerTrait;
use Inani\OxfordApiWrapper\Components\DictionaryTrait;
use Inani\OxfordApiWrapper\Components\TranslatorTrait;
use GuzzleHttp\Client;

class OxfordWrapper
{
    use TranslatorTrait,
        DefinerTrait,
        DictionaryTrait;

    protected $client;

    protected $word;

    protected $base = 'api/v1';

    protected $result;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * The word to look for
     *
     * @param $word
     * @return $this
     */
    public function lookFor($word)
    {
        $this->word = $word;
        return $this;
    }

    /**
     * Reset the parameters
     */
    protected function reset()
    {
        $this->word = null;
    }
}