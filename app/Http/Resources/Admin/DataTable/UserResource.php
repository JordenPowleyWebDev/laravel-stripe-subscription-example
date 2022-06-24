<?php

namespace App\Http\Resources\Admin\DataTable;

use App\Enums\DateFormats;
use App\Enums\UserRoles;
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
            'role'          => UserRoles::toLabel($this->role),
            'created_at'    => DateFormats::format($this->created_at, DateFormats::DATE),
            'deleted_at'    => $this->when(($this->deleted_at !== null), DateFormats::format($this->deleted_at, DateFormats::DATE)),
            'can'           => $this->permissions_array,
        ];
    }
}
