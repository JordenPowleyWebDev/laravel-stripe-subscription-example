<?php

namespace App\Http\Controllers\WebApi\Admin;

use App\Enums\UserRoles;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Http\Resources\Admin\Data\UserResource as UserDataResource;
use App\Http\Resources\Admin\DataTable\UserResource;
use App\Http\Resources\Admin\Select\RoleResource;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LangleyFoxall\ReactDynamicDataTableLaravelApi\DataTableResponder;
use Spatie\Permission\Models\Role;
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

    /**
     * UserController::data()
     *
     * @param Request $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function data(Request $request): JsonResponse
    {
        $this->authorize('viewAny', User::class);

        $response = [];

        $response['roles'] = Role::orderBy("name", "ASC")->get()->transform(function ($role) {
            return new RoleResource($role);
        });

        $response['default_role'] = Role::where('name', '=', UserRoles::ADMIN)->first()->id;

        if ($request->has('user_id') && filled($request->input('user_id'))) {
            /** @var User $user */
            $user = USer::findOrFail($request->input('user_id'));

            $this->authorize('view', $user);

            $response['user'] = new UserDataResource($user);
        }

        return response()->json($response);
    }

    /**
     * UserController::store()
     *
     * @param StoreUserRequest $request
     * @return JsonResponse
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = new User();
        $user->fill($data);
        if (array_key_exists('password', $data) && filled($data['password'])) {
            $user->password = bcrypt('password');
        }

        $user->save();

        $role = Role::findOrFail($data['role']);
        $user->syncRoles([$role]);

        $request->session()->flash('success', 'User created.');

        return response()->json([
            "message"   => "User created.",
            "user_id"   => $user->id,
        ], 201);
    }

    /**
     * UserController::update()
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $data = $request->validated();

        $user->first_name   = $data['first_name'];
        $user->last_name    = $data['last_name'];
        $user->email        = $data['email'];

        if (array_key_exists('password', $data) && filled($data['password'])) {
            $user->password = bcrypt('password');
        }

        $user->save();

        $role = Role::findOrFail($data['role']);
        $user->syncRoles([$role]);

        $request->session()->flash('success', 'User updated.');

        return response()->json([
            "message"   => "User updated.",
            "user_id"   => $user->id,
        ], 200);
    }
}
