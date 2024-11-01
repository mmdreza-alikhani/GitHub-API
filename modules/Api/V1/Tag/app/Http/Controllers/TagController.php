<?php

namespace Modules\Api\V1\Tag\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Repository;
use App\Models\Tag;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Api\V1\Repository\app\Http\Resources\RepositoryResource;
use Modules\Api\V1\Tag\app\Http\Resources\TagResource;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $tags = Tag::latest()->paginate(10);
        return successResponse([
            'data' => TagResource::collection($tags->load('repositories')),
            'links' => TagResource::collection($tags)->response()->getData()->links,
            'meta' => TagResource::collection($tags)->response()->getData()->meta
        ], 200, 'تگ ها با موفقیت دریافت شد.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:18'
        ]);

        if ($validator->fails()) {
            return errorResponse(422, $validator->messages());
        }

        $tag = Tag::create([
            'title' => $request->title
        ]);

        return successResponse($tag, 200, 'تگ با موفقیت ایجاد شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag): JsonResponse
    {
        return successResponse(new TagResource($tag), 200, 'تگ با موفقیت دریافت شد.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:18'
        ]);

        if($validator->fails()){
            return errorResponse(422, $validator->messages());
        }

        $tag->update([
            'title' => $request->title
        ]);

        return successResponse(new TagResource($tag), 200, 'تگ مورد نظر با موفقیت ویرایش شد!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag): JsonResponse
    {
        $tag->delete();

        return successResponse(new TagResource($tag), 200, 'تگ مورد نظر با موفقیت حذف شد!');
    }

    /**
     * @throws ConnectionException
     */
    public function search(): JsonResponse
    {
        syncData(auth()->user()->username);
        $keyword = request()->keyword;
        if (request()->has('keyword') && trim($keyword) != ''){
            $tags = Tag::where('title', 'LIKE', '%'.trim($keyword).'%')->latest()->paginate(10);
        }else{
            $tags = Tag::latest()->paginate(10);
        }
        return successResponse([
            'data' => TagResource::collection($tags->load('repositories')),
            'links' => TagResource::collection($tags)->response()->getData()->links,
            'meta' => TagResource::collection($tags)->response()->getData()->meta
        ], 200, 'تگ ها با موفقیت دریافت شد.');
    }
}
