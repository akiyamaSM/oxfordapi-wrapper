<?php

namespace Inani\OxfordApiWrapper;

use Inani\OxfordApiWrapper\Components\Result;
use Inani\OxfordApiWrapper\Components\Translator;
use GuzzleHttp\Client;
use Exception;

class OxfordWrapper
{
    use Translator;

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
     * Get the results
     *
     * @return mixed
     * @throws Exception
     */
    public function get()
    {
        if($this->result->getStatusCode() == 200){
            return (
                new Result(
                    json_decode(
                        $this->result->getBody()->getContents()
                    )->results
                )
            );
        }
        throw new Exception('An error occurred');
    }

    /**
     * Reset the parameters
     */
    protected function reset()
    {
        $this->reset_translator();
        $this->word = null;
    }
}