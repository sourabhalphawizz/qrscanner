<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Subscription;
use App\Services\UserSubscriptionService;
use App\Http\Requests\PaginateRequest;
use App\Http\Resources\SubscriptionResource;
use App\Http\Requests\AdministratorSubscriptionRequest;

class AdministratorSubscriptionController extends AdminController
{

    private UserSubscriptionService $userSubscriptionService;

    public function __construct(UserSubscriptionService $userSubscriptionService)
    {
        parent::__construct();
        $this->userSubscriptionService = $userSubscriptionService;
        $this->middleware(['permission:administrators_show'])->only('index', 'store', 'update', 'destroy', 'show');
    }

    public function index(PaginateRequest $request, User $administrator): \Illuminate\Http\Response | \Illuminate\Http\Resources\Json\AnonymousResourceCollection | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            return SubscriptionResource::collection($this->userSubscriptionService->list($request, $administrator));
        } catch (Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], 422);
        }
    }

    public function store(AdministratorSubscriptionRequest $request, User $administrator): \Illuminate\Http\Response | SubscriptionResource | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            return new SubscriptionResource($this->userSubscriptionService->store($request, $administrator));
        } catch (Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], 422);
        }
    }

    public function update(AdministratorSubscriptionRequest $request, User $administrator, Subscription $subscription): \Illuminate\Http\Response | SubscriptionResource | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            return new SubscriptionResource($this->userSubscriptionService->update($request, $administrator, $subscription));
        } catch (Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], 422);
        }
    }

    public function destroy(User $administrator, Subscription $subscription): \Illuminate\Http\Response | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $this->userSubscriptionService->destroy($administrator, $subscription);
            return response('', 202);
        } catch (Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], 422);
        }
    }

    public function show(User $administrator, Subscription $subscription): \Illuminate\Http\Response | SubscriptionResource | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            return new SubscriptionResource($this->userSubscriptionService->show($administrator, $subscription));
        } catch (Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], 422);
        }
    }
}
