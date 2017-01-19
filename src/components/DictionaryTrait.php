<?php

namespace Inani\OxfordApiWrapper\Components;

use Inani\OxfordApiWrapper\Exceptions\DictionaryException;
use Exception;

trait DictionaryTrait
{
    protected $synonym = false;
    protected $antonym = false;

    /**
     * Set as true to grab synonym
     *
     * @return $this
     */
    public function synonym()
    {
        $this->synonym = true;
        return $this;
    }

    /**
     * Set as true to grab antonym
     * @return $this
     */
    public function antonym()
    {
        $this->antonym = true;
        return $this;
    }

    public function fetch()
    {
        try{
            $operation = $this->getOperationDictionary();
            $this->result = $this->client->get(
                "{$this->base}/entries/en/{$this->word}/{$operation}"
            );

            if($this->result->getStatusCode() == 200){
                $this->reset_definer();
                return (
                    new DictionaryParser(
                        json_decode(
                            $this->result->getBody()->getContents()
                        )->results,
                        $this->synonym,
                        $this->antonym
                    )
                );
            }
            throw new Exception('An error occurred');

        }catch (Exception $e){
            throw new DictionaryException($e->getCode());
        }
    }

    /**
     * Check the operation
     *
     * @return string
     */
    public function getOperationDictionary()
    {
        if($this->synonym && $this->antonym){
            return "synonyms;antonyms";
        }
        if($this->antonym){
            return "antonyms";
        }
        return "synonyms";
    }
}