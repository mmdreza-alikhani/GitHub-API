<?php

namespace Modules\Api\V1\Repository\app\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @method getRawOriginal(string $string)
 */
class RepositoryResource extends JsonResource
{
    public static $wrap = 'repo';
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'repository_id' => $this->repository_id,
            'name' => $this->name,
            'language' => $this->language,
            'url' => $this->url,
            'description' => $this->description,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
