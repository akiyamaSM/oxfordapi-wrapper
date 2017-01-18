<?php

namespace Inani\OxfordApiWrapper\Components;


class TranslatorParser extends   BasicResult
{
    protected $translations = [];

    protected $examples = [];

    /**
     * Get the translation from result
     *
     * @return array
     */
    public function get()
    {
        if(! $this->isEmptyTranslation()){
            return $this->translations;
        }

        $senses = $this->result[0]
            ->lexicalEntries[0]
            ->entries[0]
            ->senses; // still need to work on
        $words = [];
        // loop over all of the senses
        foreach($senses as $sens){
            if(property_exists($sens, 'subsenses')){
                foreach($sens->subsenses as $subsense){
                    if(property_exists($subsense, 'translations')){
                        foreach($subsense->translations as $translation){
                            $words[] = $translation->text;
                        }
                    }
                }
            }

            if(property_exists($sens, 'translations')){
                foreach($sens->translations as $translation){
                    $words[] = $translation->text;
                }
            }
        }
        return ($this->translations = array_unique($words));
    }

    /**
     * Get examples from result
     *
     * @return array
     */
    public function getExamples()
    {
        if(! $this->isEmptyExample()){
            return $this->examples;
        }
        $senses = $this->result[0]
            ->lexicalEntries[0]
            ->entries[0]
            ->senses; // still need to work on
        $examples = [];
        foreach($senses as $sens){
            if(property_exists($sens, 'subsenses')){
                foreach($sens->subsenses as $subsense){
                    if(property_exists($subsense, 'examples')){
                        foreach($subsense->examples as $example){
                            $examples[$example->text] = [];
                            foreach($example->translations as $translation){
                                $examples[$example->text][] = $translation->text;
                            }
                        }
                    }
                }
            }
        }
        return ($this->examples = $examples);
    }

    /**
     * Check if the array of translations is empty
     *
     * @return bool
     */
    protected function isEmptyTranslation()
    {
        return count($this->translations) == 0;
    }

    /**
     * Check if the array of examples is empty
     *
     * @return bool
     */
    protected function isEmptyExample()
    {
        return count($this->examples) == 0;
    }
}