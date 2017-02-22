<?php


namespace Inani\OxfordApiWrapper\Components;


trait TalkerTrait
{
    public function talk()
    {
        try{
            $this->result = $this->client->get(
                "{$this->base}/entries/en/{$this->word}/pronunciations"
            );
            if($this->result->getStatusCode() == 200){
                $this->reset_definer();
                return (
                    new SpeakerParser(
                        json_decode(
                            $this->result->getBody()->getContents()
                        )->results
                    )
                );
            }
            throw new Exception('An error occurred');

        }catch (Exception $e){
            throw new Exception("Are you sure of the word {$this->word}?");
        }
    }
}