<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientRequestsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title_en'=> $this->title_en ,
            'title_ar'=>$this->title_ar,
            'description_en'=>$this->description_en,
            'description_ar'=>$this->description_ar,

            'created_at' => Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans() ,
            'updated_at' => $this->updated_at,
   ]; }
}
