<?php

namespace App\Services;

use App\Interface\NotifyServiceInterface;

class NotifyService implements NotifyServiceInterface
{
    public function notify($userData)
    {
        # get user email, telephpne, whatsapp etc and add to the API

        $client = new \GuzzleHttp\Client(['base_uri' => 'http://o4d9z.mocklab.io']);
        $response = $client->request('GET', '/notify');

        # add a pubsub to send if first attempt did not happen

        return $response;
    }
}
