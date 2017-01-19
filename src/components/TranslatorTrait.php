<?php
namespace Inani\OxfordApiWrapper\Components;

use Inani\OxfordApiWrapper\Exceptions\TranslateException;

trait TranslatorTrait
{
    protected $from;

    protected $to;

    protected $available_languages = [
      'en', 'es', 'lv', 'nso', 'zu', 'ms', 'id', 'tn', 'hi', 'ur', 'sw', 'ro'
    ];

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
     * Reset translator
     */
    protected function reset_translator()
    {
        $this->from = null;
        $this->to = null;
        $this->reset();
    }

    /**
     * Translate
     *
     * @return $this
     * @throws TranslateException
     */
    public function translate()
    {
        try{
            $this->result = $this->client->get(
                "{$this->base}/entries/{$this->from}/{$this->word}/translations={$this->to}"
            );

            if($this->result->getStatusCode() == 200){
                $this->reset_translator();
                return (
                    new TranslatorParser(
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
        $this->reset_translator();
        return $this;
    }
}