<?php

use App\Models\Repository;
use App\Models\User;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

function errorResponse($code, $message = 'Error'): JsonResponse
{

    return response()->json([

        'status' => 'Error',

        'message' => $message,

        'data' => ""

    ], $code);

};

function successResponse($data,$code,$message = null): JsonResponse
{

    return response()->json([

        'status' => 'Success',

        'message' => $message,

        'data' => $data

    ], $code);

}

/**
 * @throws ConnectionException
 */
function syncData($username): void
{
    $user = User::where('username', $username)->first();
    $response = Http::withToken($user->token)->get('https://api.github.com/users/' . $username . '/starred');
    $oldDataIds = Repository::where('user_id', $user->id)->pluck('repository_id')->toArray();
    $newDataIds = [];
    foreach ($response->object() as $repo){
        $newDataIds[] = $repo->id;
        if(!in_array($repo->id , $oldDataIds)){
            Repository::create([
                'user_id' => $user->id,
                'name' => $repo->full_name,
                'repository_id' => $repo->id,
                'language' => $repo->language,
                'url' => $repo->url,
                'description' => $repo->description != null ? $repo->description : '',
            ]);
        }
    }
    $reposToDelete = Repository::where('user_id', $user->id)->whereNotIn('repository_id', $newDataIds)->get();
    foreach ($reposToDelete as $repo){
        $repo->delete();
    }
}
