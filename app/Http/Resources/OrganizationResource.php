
<?php
/*
 * @author:    Santiago Gil Zapata 
 * @email:     sgilz@eafit.edu.co
 */

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id"=> $this->getId(),
            "name"=> $this->getName(),
            "created_at"=> $this->created_at,
        ];
    }
}