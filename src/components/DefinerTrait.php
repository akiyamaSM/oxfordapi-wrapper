<?php

namespace Inani\OxfordApiWrapper\Components;

use Inani\OxfordApiWrapper\Exceptions\TranslateException;
use Exception;

trait DefinerTrait
{
    /**
     * Define a word
     *
     * @return $this
     * @throws TranslateException
     * @throws Exception
     */
    public function define()
    {
        try{
            $this->result = $this->client->get(
                "{$this->base}/entries/en/{$this->word}/definitions"
            );

            if($this->result->getStatusCode() == 200){
                $this->reset_definer();
                return (
                    new DefinerParser(
                        json_decode(
                            $this->result->getBody()->getContents()
                        )->results
                    )
                );
            }
            throw new Exception('An error occurred');

        }catch (Exception $e){
            throw new TranslateException($e->getCode());
        }
    }


    /**
     * Get examples of the word
     *
     * @return ExampleParser
     * @throws TranslateException
     * @throws Exception
     */
    public function examples()
    {
        try{
            $this->result = $this->client->get(
                "{$this->base}/entries/en/{$this->word}/examples"
            );

            if($this->result->getStatusCode() == 200){
                $this->reset_definer();
                return (
                new ExampleParser(
                    json_decode(
                        $this->result->getBody()->getContents()
                    )->results
                )
                );
            }
            throw new Exception('An error occurred');

        }catch (Exception $e){
            throw new TranslateException($e->getCode());
        }
    }


    /**
     * Reset fields
     */
    public function reset_definer()
    {
        $this->reset();
    }
}