<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StripeSubscriptionPlanDetail\StoreStripeSubscriptionPlanDetailRequest;
use App\Http\Requests\Admin\StripeSubscriptionPlanDetail\UpdateStripeSubscriptionPlanDetailRequest;
use App\Models\StripeSubscriptionPlanDetail;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use function redirect;
use function view;

/**
 * Class StripeSubscriptionPlanDetailController
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
     * StripeSubscriptionPlanDetailController::index()
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('pages.admin.stripeSubscriptionPlanDetail.index');
    }

    /**
     * StripeSubscriptionPlanDetailController::show()
     *
     * @param StripeSubscriptionPlanDetail $stripeSubscriptionPlanDetail
     * @return Application|Factory|View
     */
    public function show(StripeSubscriptionPlanDetail $stripeSubscriptionPlanDetail)
    {
        return view('pages.admin.stripeSubscriptionPlanDetail.show', [
            "stripeSubscriptionPlanDetail" => $stripeSubscriptionPlanDetail,
        ]);
    }

    /**
     * StripeSubscriptionPlanDetailController::create()
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('pages.admin.stripeSubscriptionPlanDetail.create');
    }

    /**
     * StripeSubscriptionPlanDetailController::store()
     *
     * @param StoreStripeSubscriptionPlanDetailRequest $request
     * @return RedirectResponse
     */
    public function store(StoreStripeSubscriptionPlanDetailRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $stripeSubscriptionPlanDetail = new StripeSubscriptionPlanDetail();
        $stripeSubscriptionPlanDetail->fill($data);
        $stripeSubscriptionPlanDetail->save();

        return redirect()->route('admin.stripeSubscriptionPlanDetail.show', ["stripeSubscriptionPlanDetail" => $stripeSubscriptionPlanDetail->id])
            ->with('success', 'Stripe Subscription Plan Detail: '.$stripeSubscriptionPlanDetail->name.' Created.');
    }

    /**
     * StripeSubscriptionPlanDetailController::edit()
     *
     * @param StripeSubscriptionPlanDetail $stripeSubscriptionPlanDetail
     * @return Application|Factory|View
     */
    public function edit(StripeSubscriptionPlanDetail $stripeSubscriptionPlanDetail)
    {
        return view('pages.admin.stripeSubscriptionPlanDetail.edit', [
            "stripeSubscriptionPlanDetail"  => $stripeSubscriptionPlanDetail
        ]);
    }

    /**
     * StripeSubscriptionPlanDetailController::update()
     *
     * @param UpdateStripeSubscriptionPlanDetailRequest $request
     * @param StripeSubscriptionPlanDetail $stripeSubscriptionPlanDetail
     * @return RedirectResponse
     */
    public function update(UpdateStripeSubscriptionPlanDetailRequest $request, StripeSubscriptionPlanDetail $stripeSubscriptionPlanDetail): RedirectResponse
    {
        $data = $request->validated();

        $stripeSubscriptionPlanDetail->fill($data);
        $stripeSubscriptionPlanDetail->save();

        return redirect()->route('admin.stripeSubscriptionPlanDetail.show', ["stripeSubscriptionPlanDetail" => $stripeSubscriptionPlanDetail->id])
            ->with('success', 'Stripe Subscription Plan Detail: '.$stripeSubscriptionPlanDetail->name.' Updated.');
    }

    /**
     * StripeSubscriptionPlanDetailController::delete()
     *
     * @param StripeSubscriptionPlanDetail $stripeSubscriptionPlanDetail
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function delete(StripeSubscriptionPlanDetail $stripeSubscriptionPlanDetail)
    {
        $this->authorize('delete', $stripeSubscriptionPlanDetail);

        return view('pages.admin.stripeSubscriptionPlanDetail.delete', [
            "stripeSubscriptionPlanDetail"  => $stripeSubscriptionPlanDetail
        ]);
    }

    /**
     * StripeSubscriptionPlanDetailController::destroy()
     *
     * @param StripeSubscriptionPlanDetail $stripeSubscriptionPlanDetail
     * @return RedirectResponse
     */
    public function destroy(StripeSubscriptionPlanDetail $stripeSubscriptionPlanDetail): RedirectResponse
    {
        try {
            $stripeSubscriptionPlanDetail->delete();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An Error Occurred Archiving Stripe Subscription Plan Detail: '.$stripeSubscriptionPlanDetail->name);
        }

        return redirect()->route('admin.stripeSubscriptionPlanDetail.index')
            ->with('success', 'Stripe Subscription Plan Detail: '.$stripeSubscriptionPlanDetail->name.' Archived.');
    }

    /**
     * StripeSubscriptionPlanDetailController::restore()
     *
     * @param StripeSubscriptionPlanDetail $stripeSubscriptionPlanDetail
     * @return RedirectResponse
     */
    public function restore(StripeSubscriptionPlanDetail $stripeSubscriptionPlanDetail): RedirectResponse
    {
        $stripeSubscriptionPlanDetail->restore();

        return redirect()->route('admin.stripeSubscriptionPlanDetail.show', ['stripeSubscriptionPlanDetail' => $stripeSubscriptionPlanDetail->id])
            ->with('success', 'Stripe Subscription Plan Detail: '.$stripeSubscriptionPlanDetail->name.' Restored.');
    }
}
