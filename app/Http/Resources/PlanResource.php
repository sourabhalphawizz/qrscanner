<?php

namespace App\Http\Resources;


use App\Libraries\AppLibrary;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            "id"                => $this->id,
            "name"              => $this->name,
            'description'     => $this->description === null ? '' : $this->description,
            "flat_price"       => AppLibrary::flatAmountFormat($this->price),
            "convert_price"    => AppLibrary::convertAmountFormat($this->price),
            "currency_price"   => AppLibrary::currencyAmountFormat($this->price),
            "price"            => $this->price,
            "validity"            => $this->validity,
            "status"            => $this->status,
        ];
    }
}
