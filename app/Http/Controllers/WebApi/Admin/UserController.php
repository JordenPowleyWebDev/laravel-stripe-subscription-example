<?php

namespace App\Http\Controllers\WebApi\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\DataTable\UserResource;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LangleyFoxall\ReactDynamicDataTableLaravelApi\DataTableResponder;
use function filled;

/**
 * Class UserController
 * @package App\Http\Controllers\WebApi\Admin\BeerManagement
 */
class UserController extends Controller
{
    /**
     * UserController::dataTable()
     *
     * @param Request $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function dataTable(Request $request): JsonResponse
    {
        $this->authorize('viewAny', User::class);

        return (new DataTableResponder(User::class, $request))
            ->setPerPage($request->get('perPage', 15))
            ->query(function ($query) use ($request) {

                $query->select([
                    'users.id',
                    'users.first_name',
                    'users.last_name',
                    'users.email',
                    'users.created_at',
                    'users.deleted_at',
                    'roles.name as role',
                ]);

                if ($request->has('filterDeleted') && filled($request->filterDeleted)) {
                    switch ($request->filterDeleted) {
                        case 'active':
                            $query->whereNull('users.deleted_at');
                            break;
                        case 'deleted':
                            $query->withTrashed();
                            $query->whereNotNull('users.deleted_at');
                            break;
                    }
                }

                $query->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id');
                $query->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id');

                $query->where(function ($query) use ($request) {
                    $searchTerm = $request->searchTerm ?? "";
                    $query->orWhere(DB::raw('CONCAT(users.first_name, " ", users.last_name)'), 'LIKE', '%'.$searchTerm.'%');
                    $query->orWhere('users.first_name', 'LIKE', '%'.$searchTerm.'%');
                    $query->orWhere('users.last_name', 'LIKE', '%'.$searchTerm.'%');
                    $query->orWhere('users.email', 'LIKE', '%'.$searchTerm.'%');
                    $query->orWhere('roles.name', 'LIKE', '%'.$searchTerm.'%');
                });
            })
            ->collectionManipulator(function (Collection $collection) use ($request) {
                return $collection->map(function (User $user) use ($request) {
                    return new UserResource($user);
                });
            })
            ->respond();
    }
}
