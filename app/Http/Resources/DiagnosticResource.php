<?php

/**
 * @author: Santiago Gil
 * @editor: Felipe Sosa
 * @email: sgilz@eafit.edu.co
 */

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class DiagnosticResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id"=> $this->getId(),
            'free_cash_flow_to_total_debt'=> $this->getFreeCashFlow(),
            'accounts_payable_turnover'=> $this->getAccounts(),
            'operating_margin'=> $this->getOperatingMargin(),
            'sales_per_employee'=> $this->getSales(),
            'asset_turnover'=> $this->getAssetTurnover(),
            'total_debt_to_total_assets'=> $this->getTotalDebt(),
            'current_ratio'=> $this->getCurrentRatio(),
            'revenue_growth_year_over_year'=> $this->getRevenueGrowth(),
            'return_on_assets'=> $this->getReturnOnAssets(),
            "cluster_id"=> $this->getClassificationId(),
            "advise_id"=> $this->getAdviseId(),
            "user_id"=> $this->getUserId(),
            "created_at"=> $this->created_at,
        ];
    }
}