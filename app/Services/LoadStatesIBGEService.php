<?php


namespace App\Services;


use App\Models\States;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class LoadStatesIBGEService
{
    private $baseUrl = 'https://servicodados.ibge.gov.br/';
    private $resourceUri = 'api/v1/localidades/estados';

    public function loadStates():bool
    {
        $output = false;
        try{
            $client = new Client(['base_uri' => $this->baseUrl]);

            $response = $client->get($this->resourceUri);
            $states = json_decode($response->getBody()->getContents());

            foreach ($states as $state){
                States::updateOrCreate([
                    'name' => data_get($state, 'nome'),
                    'uf' => data_get($state, 'sigla'),
                ]);
            }

            $output = true;
        } catch (\Exception $e){
            dd( $e);
            Log::error($e->getMessage());
        }

        return $output;
    }
}
