<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class TeamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        try {

            return parent::toArray($request);

        } catch (\Exception $e) {

            Log::info('Error toArray TeamResource: '.$e->getMessage().' Line: '.$e->getLine());

        }
    }
}
