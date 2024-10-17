<?php

namespace App\Http\Controllers\Admin;


use Exception;
use App\Models\Room;
use App\Exports\RoomExport;
use App\Services\RoomService;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\PaginateRequest;
use App\Http\Requests\RoomRequest;
use App\Http\Resources\RoomResource;

class RoomController extends AdminController
{
    private RoomService $roomService;

    public function __construct(RoomService $roomService)
    {
        parent::__construct();
        $this->roomService = $roomService;
        $this->middleware(['permission:rooms'])->only('export');
        $this->middleware(['permission:rooms_create'])->only('store');
        $this->middleware(['permission:rooms_edit'])->only('update');
        $this->middleware(['permission:rooms_delete'])->only('destroy');
        $this->middleware(['permission:rooms_show'])->only('show');
    }

    public function index(PaginateRequest $request): \Illuminate\Http\Response | \Illuminate\Http\Resources\Json\AnonymousResourceCollection | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            return RoomResource::collection($this->roomService->list($request));
        } catch (Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], 422);
        }
    }


    public function store(
        RoomRequest $request
    ): \Illuminate\Http\Response | RoomResource | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory {
        try {
            return new RoomResource($this->roomService->store($request));
        } catch (Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], 422);
        }
    }

    public function show(
        Room $room
    ): \Illuminate\Http\Response | RoomResource | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory {
        try {
            return new RoomResource($this->roomService->show($room));
        } catch (Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], 422);
        }
    }

    public function update(
        RoomRequest $request,
        Room $room
    ): \Illuminate\Http\Response | RoomResource | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory {
        try {
            return new RoomResource($this->roomService->update($request, $room));
        } catch (Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], 422);
        }
    }

    public function destroy(
        Room $room
    ): \Illuminate\Http\Response | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory {
        try {
            $this->roomService->destroy($room);
            return response('', 202);
        } catch (Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], 422);
        }
    }

    public function export(PaginateRequest $request): \Illuminate\Http\Response | \Symfony\Component\HttpFoundation\BinaryFileResponse | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            return Excel::download(new RoomExport($this->roomService, $request), 'Room.xlsx');
        } catch (Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], 422);
        }
    }
}