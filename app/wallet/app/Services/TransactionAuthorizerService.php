<?php

namespace App\Services;

use App\Repositories\Interface\TransactionAuthorizerInterface;

class TransactionAuthorizerService implements TransactionAuthorizerInterface
{
    public function authorize()
    {
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://run.mocky.io/v3']);
        $response = $client->request('GET', '/8fafdd68-a090-496f-8c9a-3442cf30dae6');

        return $response;
    }
}
