<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class MainController
{
    /**
     * @throws ConnectionException
     */
    public function GetAllData()
    {

        $user = auth()->user();
        $response = Http::withToken('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')->get('https://api.github.com/users/' . $user->name . '/starred');

        foreach ($response->object() as $repo){
            dd($repo->language);
        }
    }
}
