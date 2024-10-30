<?php

namespace App\Http\Controllers;

use App\Models\Repository;
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
            Repository::create([
                'user_id' => auth()->id(),
                'name' => $repo->name,
                'repository_id' => $repo->id,
                'language' => $repo->language,
                'url' => $repo->url,
                'description' => 'nuthing',
            ]);
        }
    }
}
