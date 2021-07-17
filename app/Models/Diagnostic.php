<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Diagnostic extends Model
{
    use HasFactory;

    protected $fillable = [
        'free_cash_flow_to_total_debt',
        'accounts_payable_turnover',
        'operating_margin',
        'sales_per_employee',
        'asset_turnover',
        'total_debt_to_total_assets',
        'current_ratio',
        'revenue_growth_year_over_year',
        'return_on_assets',
        'user_id',
        'organization_id',
        'classification_id',
        'advise_id',
    ];

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getFreeCashFlow()
    {
        return $this->attributes['free_cash_flow_to_total_debt'];
    }

    public function setFreeCashFlow($fcf)
    {
        $this->attributes['free_cash_flow_to_total_debt'] = $fcf;
    }

    public function getAccounts()
    {
        return $this->attributes['accounts_payable_turnover'];
    }

    public function setAccounts($apt)
    {
        $this->attributes['accounts_payable_turnover'] = $apt;
    }
    
    public function getOperatingMargin()
    {
        return $this->attributes['operating_margin'];
    }

    public function setOperatingMargin($om)
    {
        $this->attributes['operating_margin'] = $om;
    }

    public function getSales()
    {
        return $this->attributes['sales_per_employee'];
    }

    public function setSales($spe)
    {
        $this->attributes['sales_per_employee'] = $spe;
    }

    public function getAssetTurnover()
    {
        return $this->attributes['asset_turnover'];
    }

    public function setAssetTurnover($at)
    {
        $this->attributes['asset_turnover'] = $at;
    }

    public function getTotalDebt()
    {
        return $this->attributes['total_debt_to_total_assets'];
    }

    public function setTotalDebt($td)
    {
        $this->attributes['total_debt_to_total_assets'] = $td;
    }

    public function getCurrentRatio()
    {
        return $this->attributes['current_ratio'];
    }

    public function setCurrentRatio($cr)
    {
        $this->attributes['current_ratio'] = $cr;
    }

    public function getRevenueGrowth()
    {
        return $this->attributes['revenue_growth_year_over_year'];
    }

    public function setRevenueGrowth($rg)
    {
        $this->attributes['revenue_growth_year_over_year'] = $rg;
    }

    public function getReturnOnAssets()
    {
        return $this->attributes['return_on_assets'];
    }

    public function setReturnOnAssets($roa)
    {
        $this->attributes['return_on_assets'] = $roa;
    }

    public function getClassificationId()
    {
        return $this->attributes['classification_id'];
    }

    public function setClassificationId($classification)
    {
        $this->attributes['classification_id'] = $classification;
    }

    public function getAdviseId()
    {
        return $this->attributes['advise_id'];
    }

    public function setAdviseId($advise)
    {
        $this->attributes['advise_id'] = $advise;
    }

    public function getOrganizationId()
    {
        return $this->attributes['organization_id'];
    }

    public function setOrganizationId($organization)
    {
        $this->attributes['organization_id'] = $organization;
    }

    public function getUserId()
    {
        return $this->attributes['user_id'];
    }

    public function setUserId($userId)
    {
        $this->attributes['user_id'] = $userId;
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
    
    public function classification()
    {
        return $this->hasOne(Classification::class);
    }

    public function advise()
    {
        return $this->hasOne(Advise::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function validate(Request $request)
    {
        return Validator::make($request->all(), [
            'free_cash_flow_to_total_debt' => 'required|numeric|min:0',
            'accounts_payable_turnover' => 'required|numeric|min:0',
            'operating_margin' => 'required|numeric|min:0',
            'sales_per_employee' => 'required|numeric|min:0',
            'asset_turnover' => 'required|numeric|min:0',
            'total_debt_to_total_assets' => 'required|numeric|between:0,1',
            'current_ratio' => 'required|numeric',
            'revenue_growth_year_over_year' => 'required|numeric',
            'return_on_assets' => 'required|numeric|min:0',
            'organization_id' => 'required|integer|max:100',
        ]);
    }
}