<?php

namespace App\Http\Resources;

use App\Libraries\AppLibrary;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request) : array
    {
        return [
            "id"         => $this->id,
            "user_id"    => $this->user_id,
            "plan"      => $this->plan,
            "amount"    => AppLibrary::currencyAmountFormat($this->amount),
            "validity"  => $this->validity,
            "start_date"   => AppLibrary::date($this->start_date),
            "end_date"  => AppLibrary::date($this->end_date),
        ];
    }
}
