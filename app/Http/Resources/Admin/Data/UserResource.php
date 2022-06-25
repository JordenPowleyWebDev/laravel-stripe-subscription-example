<?php

namespace App\Http\Resources\Admin\Data;

use App\Enums\DateFormats;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UserResource
 */
class UserResource extends JsonResource
{
    /**
     * UserResource::toArray().
     *
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        /** @var User $this */
        return [
            'id'            => $this->id,
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'email'         => $this->email,
            'role'          => $this->role_id,
            'created_at'    => DateFormats::format($this->created_at, DateFormats::DB),
            'deleted_at'    => $this->when(($this->deleted_at !== null), DateFormats::format($this->deleted_at, DateFormats::DB)),
            'can'           => $this->permissions_array,
        ];
    }
}
