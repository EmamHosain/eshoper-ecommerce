<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'description' => $this->description,
            'max_uses' => $this->max_uses,
            'max_uses_user' => $this->max_uses_user,
            'max_users_user' => $this->max_uses_user,
            'type' => $this->type,
            'status' => $this->status,
            'discount_amount' => $this->discount_amount,
            'min_amount' => $this->min_amount,
            'starts_at' => $this->starts_at,
            'expires_at' => $this->expires_at,
        ];
    }
}
