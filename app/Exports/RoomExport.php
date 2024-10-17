<?php

namespace App\Exports;

use App\Http\Requests\PaginateRequest;
use App\Services\RoomService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RoomExport implements FromCollection, WithHeadings
{

    public RoomService $roomService;
    public PaginateRequest $request;

    public function __construct(RoomService $roomService, $request)
    {
        $this->roomService = $roomService;
        $this->request            = $request;
    }

    public function collection()
    {
        $roomArray = [];
        $roomsArray     = $this->roomService->list($this->request);

        foreach ($roomsArray as $room) {
            $roomArray[] = [
                $room->name,
                $room->size,
                trans('statuse.' . $room->status),
            ];
        }
        return collect($roomArray);
    }

    public function headings(): array
    {
        return [
            trans('all.label.name'),
            trans('all.label.size'),
            trans('all.label.status')
        ];
    }
}