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
        $senses = $this->result[0]
                        ->lexicalEntries[0]
                        ->entries[0]
                        ->senses; // still need to work on
        $definitions = [];
        // loop over all of the senses
        foreach($senses as $sens){
            if(property_exists($sens, 'definitions')){
                foreach($sens->definitions as $definition){
                    $definitions[] = str_replace(':','',$definition);
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
}