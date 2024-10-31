<?php

namespace Modules\Api\V1\Repository\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Repository;
use App\Models\Tag;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use JetBrains\PhpStorm\NoReturn;
use Modules\Api\V1\Repository\app\Http\Resources\RepositoryResource;

class RepositoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $repositories = Repository::where('user_id', auth()->id())->with('tags')->latest()->paginate(10);
        return successResponse([
            'data' => RepositoryResource::collection($repositories),
            'links' => RepositoryResource::collection($repositories)->response()->getData()->links,
            'meta' => RepositoryResource::collection($repositories)->response()->getData()->meta
        ], 200, 'ریپوزیتوری ها با موفقیت دریافت شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Repository $repository): JsonResponse
    {
        return successResponse(new RepositoryResource($repository), 200, 'ریپوزیتوری با موفقیت دریافت شد.');
    }

    #[NoReturn] public function update(Repository $repository, Request $request): JsonResponse
    {
        $user = auth()->user();
        if ($repository->user_id == $user->id){
            $repository->tags()->sync($request->tag_ids);
            return successResponse(new RepositoryResource($repository), 200, 'تگ های ریپوزیتوری با موفقیت ویرایش شد.');
        }else{
            return errorResponse('403');
        }
    }
    /**
     * Remove the specified resource from storage.
     * @throws ConnectionException
     */
    public function removeStar(Repository $repository): JsonResponse
    {
        $user = auth()->user();
        $unstarRepo = Http::dd()->withToken($user->token)->get('https://api.github.com/user/starred/' . $repository->name);
        return successResponse(new RepositoryResource($repository), 200, 'ریپوزیتوری با موفقیت حذف شد.');
    }
}
