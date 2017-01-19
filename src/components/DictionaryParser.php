<?php


namespace Inani\OxfordApiWrapper\Components;


class DictionaryParser extends BasicResult
{
    protected $synonym;
    protected $antonym;

    protected $dictionary = [];

    public function __construct(array $result, $synonym, $antonym)
    {
        parent::__construct($result);
        $this->synonym = $synonym;
        $this->antonym = $antonym;
    }

    public function get()
    {
        if(! $this->isEmptyDictionary()){
            return $this->dictionary;
        }

        $dictionary = [];

        $lexicales = $this->result[0]
                          ->lexicalEntries;

        foreach($lexicales as $lexical){
            if(property_exists($lexical, 'entries')){
                foreach($lexical->entries as $entry){
                    if(property_exists($entry, 'senses')){
                        foreach($entry->senses as $sens){
                            if($this->synonym){
                                if(property_exists($sens, 'synonyms')){
                                    foreach($sens->synonyms as $synonym){
                                        $dictionary ['synonyms'][] = $synonym->text;
                                    }
                                }
                            }
                            if($this->antonym){
                                if(property_exists($sens, 'antonyms')){
                                    foreach($sens->antonyms as $antonym){
                                        $dictionary ['antonyms'][] = $antonym->text;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return ($this->dictionary = $dictionary);
    }

    /**
     * Get only synonyms
     *
     * @return null|array
     */
    public function synonyms()
    {
        if(!$this->synonym){
            return null;
        }

        return $this->get()['synonyms'];
    }

    /**
     * Get only antonyms
     *
     * @return null|array
     */
    public function antonyms()
    {
        if(!$this->antonym){
            return null;
        }

        return $this->get()['antonyms'];
    }

    /**
     * Check out if the dictionary is empty
     *
     * @return bool
     */
    public function isEmptyDictionary()
    {
        return count($this->dictionary) == 0;
    }
}