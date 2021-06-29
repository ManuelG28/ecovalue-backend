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
        'free_cash_flow',
        'accounts_payable_turnover',
        'operating_margin',
        'sales_per_employee',
        'asset_turnover',
        'total_debt',
        'current_ratio',
        'revenue_growth',
        'return_on_assets',
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
        return $this->attributes['free_cash_flow'];
    }

    public function setFreeCashFlow($fcf)
    {
        $this->attributes['free_cash_flow'] = $fcf;
    }

    public function getAccounts()
    {
        return $this->attributes['accounts_payable_turnover'];
    }

    public function setAccounts($apt)
    {
        $this->attributes['accounts_payable_turnover'] = $apt;
    }
    
    public function getOperationMargin()
    {
        return $this->attributes['operating_margin'];
    }

    public function setOperationMargin($om)
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

    public function setAsseTTurnover($at)
    {
        $this->attributes['asset_turnover'] = $at;
    }

    public function getTotalDebt()
    {
        return $this->attributes['total_debt'];
    }

    public function setTotalDebt($td)
    {
        $this->attributes['total_debt'] = $td;
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
        return $this->attributes['revenue_growth'];
    }

    public function setRevenueGrowth($rg)
    {
        $this->attributes['revenue_growth'] = $rg;
    }

    public function getReturnOnAssets()
    {
        return $this->attributes['return_on_assets'];
    }

    public function setReturnOnAssets($roa)
    {
        $this->attributes['return_on_assets'] = $roa;
    }

    public function getClassification()
    {
        return $this->attributes['classification'];
    }

    public function setClassification($classification)
    {
        $this->attributes['classification'] = $classification;
    }

    public function getAdvise()
    {
        return $this->attributes['advise'];
    }

    public function setAdvise($advise)
    {
        $this->attributes['advise'] = $advise;
    }

    public function classification()
    {
        return $this->hasOne(Classification::class);
    }

    public function advise()
    {
        return $this->hasOne(Advise::class);
    }

    public static function validate(Request $request)
    {
        return Validator::make($request->all(), [
            'free_cash_flow' => 'required|numeric|min:0',
            'accounts_payable_turnover' => 'required|numeric|min:0',
            'operating_margin' => 'required|numeric|min:0',
            'sales_per_employee' => 'required|numeric|min:0',
            'asset_turnover' => 'required|numeric|min:0',
            'total_debt' => 'required|numeric|between:0,1',
            'current_ratio' => 'required|numeric',
            'revenue_growth' => 'required|numeric',
            'return_on_assets' => 'required|numeric|min:0',
        ]);
    }
}