<?php

namespace Inani\OxfordApiWrapper\Components;


class DefinerParser extends BasicResult
{
    protected $definitions = [];

    /**
     * Return an array of definitions
     *
     * @return array
     */
    public function get()
    {
        if(! $this->isEmptyDefinitions()){
            return $this->definitions;
        }
        $lexicales = $this->result[0]->lexicalEntries;
        $definitions = [];

        foreach($lexicales as $lexical){
            if(property_exists($lexical, 'entries')){
                foreach($lexical->entries as $entry){
                    if(property_exists($entry, 'senses')){
                        foreach($entry->senses as $sens){
                            foreach($sens->definitions as $definition){
                                $definitions[] = str_replace(':','',$definition);
                            }
                        }
                    }
                }
            }
        }
        return ($this->definitions = $definitions);
    }

    /**
     * Check if the array of definitions is empty
     *
     * @return bool
     */
    protected function isEmptyDefinitions()
    {
        return count($this->definitions) == 0;
    }

    public function getResult()
    {
        return $this->result;
    }
}