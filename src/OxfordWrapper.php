<?php

namespace Inani\OxfordApiWrapper;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Exception;

class OxfordWrapper
{
    protected $client;

    protected $word;

    protected $from;

    protected $to;

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
     * Source language
     *
     * @param $from
     * @return $this
     */
    public function from($from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * Target language
     *
     * @param $to
     * @return $this
     */
    public function to($to)
    {
        $this->to = $to;
        return $this;
    }

    /**
     * Translate
     *
     * @return $this
     * @throws Exception
     */
    public function translate()
    {
        try{
            $this->result = $this->client->get(
                "{$this->base}/entries/{$this->from}/{$this->word}/translations={$this->to}"
            );
        }catch (Exception $e){
            throw new Exception('parameters not found!');
        }
        $this->reset();
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
        if($this->result->getStatusCode() == 200)
            return $this->result;
        throw new Exception('Error occured');
    }

    /**
     * Reset the parameters
     */
    protected function reset()
    {
        $this->from = null;
        $this->to = null;
        $this->word = null;
    }
}