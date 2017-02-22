<?php


namespace Inani\OxfordApiWrapper\Components;


class SpeakerParser extends BasicResult
{
    protected $phonetics = [];

    /**
     * We will grab the first Element Only
     *
     * @return array
     */
    public function get()
    {
        if(! $this->isEmptyPhonetics()){
            return $this->phonetics;
        }

        $phonetic = $this->result[0]->lexicalEntries[0]->pronunciations[0];
        if(! is_null($phonetic)){
            $this->phonetics = [
                'audio' => $phonetic->audioFile,
                'spelling' => $phonetic->phoneticSpelling,
                'notation' => $phonetic->phoneticNotation,
            ];
            return $this->phonetics;
        }
        return [];
    }

    /**
     * Get the spelling
     *
     * @return mixed
     */
    public function spell()
    {
        return $this->get()['spelling'];
    }

    /**
     * Get the spelling
     *
     * @return mixed
     */
    public function notation()
    {
        return $this->get()['notation'];
    }

    /**
     * Get the MP3 file
     *
     * @return mixed
     */
    public function speak()
    {
        return $this->get()['audio'];
    }

    /**
     * Check out if there are any results in it
     *
     * @return bool
     */
    protected function isEmptyPhonetics()
    {
        return count($this->phonetics) == 0;
    }
}