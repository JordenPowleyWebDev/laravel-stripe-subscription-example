<?php

namespace App\Http\Controllers\WebApi\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\DataTable\UserResource;
use App\Models\StripeSubscriptionPlanDetail;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LangleyFoxall\ReactDynamicDataTableLaravelApi\DataTableResponder;
use function filled;

/**
 * Class StripeSubscriptionPlanDetailController
 * @package App\Http\Controllers\WebApi\Admin\BeerManagement
 */
class StripeSubscriptionPlanDetailController extends Controller
{
    /**
     * StripeSubscriptionPlanDetailController::dataTable()
     *
     * @param Request $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function dataTable(Request $request): JsonResponse
    {
        $this->authorize('viewAny', StripeSubscriptionPlanDetail::class);

        return (new DataTableResponder(StripeSubscriptionPlanDetail::class, $request))
            ->setPerPage($request->get('perPage', 15))
            ->query(function ($query) use ($request) {

                $query->select([
                    'stripe_subscription_plan_details.*',
                ]);

                if ($request->has('filterDeleted') && filled($request->filterDeleted)) {
                    switch ($request->filterDeleted) {
                        case 'active':
                            $query->whereNull('stripe_subscription_plan_details.deleted_at');
                            break;
                        case 'deleted':
                            $query->withTrashed();
                            $query->whereNotNull('stripe_subscription_plan_details.deleted_at');
                            break;
                    }
                }

                $query->where(function ($query) use ($request) {
                    $searchTerm = $request->searchTerm ?? "";
//                    $query->orWhere(DB::raw('CONCAT(users.first_name, " ", users.last_name)'), 'LIKE', '%'.$searchTerm.'%');
//                    $query->orWhere('users.first_name', 'LIKE', '%'.$searchTerm.'%');
//                    $query->orWhere('users.last_name', 'LIKE', '%'.$searchTerm.'%');
//                    $query->orWhere('users.email', 'LIKE', '%'.$searchTerm.'%');
//                    $query->orWhere('roles.name', 'LIKE', '%'.$searchTerm.'%');
                });
            })
//            ->collectionManipulator(function (Collection $collection) use ($request) {
//                return $collection->map(function (User $user) use ($request) {
//                    return new UserResource($user);
//                });
//            })
            ->respond();
    }
}
