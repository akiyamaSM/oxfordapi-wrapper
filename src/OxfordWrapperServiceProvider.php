<?php

namespace Inani\OxfordApiWrapper;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class OxfordWrapperServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Client::class, function(){
            return new Client([
                'base_uri' => env('OXFORD_API_BASE_URI'),
                'headers' => [
                    "app_id" => env('OXFORD_APP_ID'),
                    "app_key" => env('OXFORD_APP_KEY')
                ]
            ]);
        });

        $this->app->bind(OxfordWrapper::class, function ($app){
            $client = $app->make(Client::class);
            return new OxfordWrapper($client);
        });
    }
}