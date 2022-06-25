<?php

namespace App\Http\Controllers\WebApi\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StripeSubscriptionPlanDetail\StoreStripeSubscriptionPlanDetailRequest;
use App\Http\Requests\Admin\StripeSubscriptionPlanDetail\UpdateStripeSubscriptionPlanDetailRequest;
use App\Http\Resources\Admin\Data\StripeSubscriptionPlanDetailResource as StripeSubscriptionPlanDetailDataResource;
use App\Http\Resources\Admin\DataTable\StripeSubscriptionPlanDetailResource;
use App\Models\StripeSubscriptionPlanDetail;
use App\Subscription\SubscriptionTiers;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
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
     * StripeSubscriptionPlanDetailController::__construct().
     */
    public function __construct()
    {
        $this->authorizeResource(StripeSubscriptionPlanDetail::class, 'stripeSubscriptionPlanDetail');
    }

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
                    $query->orWhere('stripe_subscription_plan_details.name', 'LIKE', '%'.$searchTerm.'%');
                    $query->orWhere('stripe_subscription_plan_details.tier', 'LIKE', '%'.$searchTerm.'%');
                    $query->orWhere('stripe_subscription_plan_details.display_price', 'LIKE', '%'.$searchTerm.'%');
                    $query->orWhere('stripe_subscription_plan_details.trial_length_days', 'LIKE', '%'.$searchTerm.'%');
                });
            })
            ->collectionManipulator(function (Collection $collection) use ($request) {
                return $collection->map(function (StripeSubscriptionPlanDetail $stripeSubscriptionPlanDetail) use ($request) {
                    return new StripeSubscriptionPlanDetailResource($stripeSubscriptionPlanDetail);
                });
            })
            ->respond();
    }

    /**
     * StripeSubscriptionPlanDetailController::data()
     *
     * @param Request $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function data(Request $request): JsonResponse
    {
        $this->authorize('viewAny', StripeSubscriptionPlanDetail::class);

        $response = [];

        $response['tiers'] = SubscriptionTiers::toInputArray();

        $response['default_tier'] = SubscriptionTiers::FREE;

        if ($request->has('stripe_subscription_plan_detail_id') && filled($request->input('stripe_subscription_plan_detail_id'))) {
            /** @var StripeSubscriptionPlanDetail $stripeSubscriptionPlanDetail */
            $stripeSubscriptionPlanDetail = StripeSubscriptionPlanDetail::findOrFail($request->input('stripe_subscription_plan_detail_id'));

            $this->authorize('view', $stripeSubscriptionPlanDetail);

            $response['stripe_subscription_plan_detail'] = new StripeSubscriptionPlanDetailDataResource($stripeSubscriptionPlanDetail);
        }

        return response()->json($response);
    }

    /**
     * StripeSubscriptionPlanDetailController::store()
     *
     * @param StoreStripeSubscriptionPlanDetailRequest $request
     * @return JsonResponse
     */
    public function store(StoreStripeSubscriptionPlanDetailRequest $request): JsonResponse
    {
        $data = $request->validated();

        $stripeSubscriptionPlanDetail = new StripeSubscriptionPlanDetail();
        $stripeSubscriptionPlanDetail->fill($data);
        $stripeSubscriptionPlanDetail->save();

        $message = 'Stripe Subscription Plan Detail: '.$stripeSubscriptionPlanDetail->name.' Created.';
        $request->session()->flash('success', $message);

        return response()->json([
            "message"                               => $message,
            "stripe_subscription_plan_detail_id"    => $stripeSubscriptionPlanDetail->id,
        ], 201);
    }

    /**
     * StripeSubscriptionPlanDetailController::update()
     *
     * @param UpdateStripeSubscriptionPlanDetailRequest $request
     * @param StripeSubscriptionPlanDetail $stripeSubscriptionPlanDetail
     * @return JsonResponse
     */
    public function update(UpdateStripeSubscriptionPlanDetailRequest $request, StripeSubscriptionPlanDetail $stripeSubscriptionPlanDetail): JsonResponse
    {
        $data = $request->validated();

        $stripeSubscriptionPlanDetail->fill($data);
        $stripeSubscriptionPlanDetail->save();

        $message = 'Stripe Subscription Plan Detail: '.$stripeSubscriptionPlanDetail->name.' Updated.';
        $request->session()->flash('success', $message);

        return response()->json([
            "message"                               => $message,
            "stripe_subscription_plan_detail_id"    => $stripeSubscriptionPlanDetail->id,
        ], 200);
    }
}
