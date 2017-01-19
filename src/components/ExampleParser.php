<?php

namespace Inani\OxfordApiWrapper\Components;


class ExampleParser extends BasicResult
{
    protected $examples = [];

    /**
     * Return an array of definitions
     *
     * @return array
     */
    public function get()
    {
        if(! $this->isEmptyExamples()){
            return $this->examples;
        }
        $examples = [];

        $lexicales = $this->result[0]
                          ->lexicalEntries;

        foreach($lexicales as $lexical){
            if(property_exists($lexical, 'entries')){
                foreach($lexical->entries as $entry){
                    if(property_exists($entry, 'senses')){
                        foreach($entry->senses as $sens){
                            foreach($sens->examples as $example){
                                $examples[] = $example->text;
                            }
                        }
                    }
                }
            }
        }
        return ($this->examples = $examples);
    }

    /**
     * Check if the array of definitions is empty
     *
     * @return bool
     */
    protected function isEmptyExamples()
    {
        return count($this->examples) == 0;
    }
}