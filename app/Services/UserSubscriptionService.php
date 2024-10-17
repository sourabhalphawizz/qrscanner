<?php

namespace App\Services;

use Exception;
use App\Models\User;
use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\PaginateRequest;
use Carbon\Carbon;

class UserSubscriptionService
{
    /**
     * @throws Exception
     */
    public $subscription;
    public $subscriptionFilter = ['plan', 'amount', 'validity', 'start_date', 'end_date'];

    /**
     * @throws Exception
     */
    public function list(PaginateRequest $request, User $user)
    {
        try {
            $requests    = $request->all();
            $method      = $request->get('paginate', 0) == 1 ? 'paginate' : 'get';
            $methodValue = $request->get('paginate', 0) == 1 ? $request->get('per_page', 10) : '*';
            $orderColumn = $request->get('order_column') ?? 'id';
            $orderType   = $request->get('order_type') ?? 'desc';

            return Subscription::where('user_id', $user->id)->where(function ($query) use ($requests) {
                foreach ($requests as $key => $request) {
                    if (in_array($key, $this->subscriptionFilter)) {
                        $query->where($key, 'like', '%' . $request . '%');
                    }
                }
            })->orderBy($orderColumn, $orderType)->$method(
                $methodValue
            );
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            throw new Exception($exception->getMessage(), 422);
        }
    }

    /**
     * @throws Exception
     */
    public function store($request, User $user): Subscription
    {
        try {
            $plan = Plan::findOrFail($request->plan_id);
            $start_date = Carbon::parse($request->start_date)->format('Y-m-d');
            $end_date = Carbon::parse($request->start_date)->addMonths($plan->validity)->format('Y-m-d');
            DB::transaction(function () use ($request, $user, $plan, $start_date, $end_date) {
                $this->subscription = Subscription::create([
                    'user_id' => $user->id,
                    'plan' => $plan->name,
                    'amount' => $plan->price,
                    'validity' => $plan->validity,
                    'start_date' => $start_date,
                    'end_date' => $end_date
                ]);
            });
            return $this->subscription;
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            throw new Exception($exception->getMessage(), 422);
        }
    }

    /**
     * @throws Exception
     */
    public function update($request, User $user, Subscription $subscription)
    {
        try {
            if ($user->id == $subscription->user_id) {
                return tap($subscription)->update($request->validated());
            } else {
                throw new Exception(trans('all.user_match'), 422);
            }
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            throw new Exception($exception->getMessage(), 422);
        }
    }

    /**
     * @throws Exception
     */
    public function destroy(User $user, Subscription $subscription): void
    {
        try {
            if ($user->id == $subscription->user_id) {
                $subscription->delete();
            } else {
                throw new Exception(trans('all.user_match'), 422);
            }
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            throw new Exception($exception->getMessage(), 422);
        }
    }

    /**
     * @throws Exception
     */
    public function show(User $user, Subscription $subscription): Subscription
    {
        try {
            if ($user->id == $subscription->user_id) {
                return $subscription;
            } else {
                throw new Exception(trans('all.user_match'), 422);
            }
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            throw new Exception($exception->getMessage(), 422);
        }
    }
}