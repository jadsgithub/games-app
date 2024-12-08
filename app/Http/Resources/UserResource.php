<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class UserResource extends JsonResource
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

            Log::info('Error toArray UserResource: '.$e->getMessage().' Line: '.$e->getLine());

        }
    }
}
