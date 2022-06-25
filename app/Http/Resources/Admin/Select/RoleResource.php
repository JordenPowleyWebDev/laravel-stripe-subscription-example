<?php

namespace App\Http\Resources\Admin\Select;

use App\Enums\UserRoles;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\Permission\Models\Role;

/**
 * Class RoleResource
 */
class RoleResource extends JsonResource
{
    /**
     * RoleResource::toArray().
     *
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        /** @var Role $this */
        return [
            "value" => strval($this->id),
            "label" => UserRoles::toLabel($this->name),
        ];
    }
}
