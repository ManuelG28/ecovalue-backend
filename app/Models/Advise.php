<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Advise extends Model
{
    use HasFactory;

    protected $fillable = [
        'leverage',
        'growth',
        'eficiency',
        'liquidity',
        'cost_effectiveness',
        'solvency'
    ];

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getLeverage()
    {
        return $this->attributes['leverage'];
    }

    public function setLeverage($leverage)
    {
        $this->attributes['leverage'] = $leverage;
    }

    public function getGrowth()
    {
        return $this->attributes['growth'];
    }

    public function setGrowth($growth)
    {
        $this->attributes['growth'] = $growth;
    }

    public function getEficiency()
    {
        return $this->attributes['eficiency'];
    }

    public function setEficiency($eficiency)
    {
        $this->attributes['eficiency'] = $eficiency;
    }

    public function getLiquidity()
    {
        return $this->attributes['liquidity'];
    }

    public function setLiquidity($liquidity)
    {
        $this->attributes['liquidity'] = $liquidity;
    }
    
    public function getCostEffectiveness()
    {
        return $this->attributes['cost_effectiveness'];
    }

    public function setCostEffectiveness($cost_effectiveness)
    {
        $this->attributes['cost_effectiveness'] = $cost_effectiveness;
    }

    public function getSolvency()
    {
        return $this->attributes['solvency'];
    }

    public function setSolvency($solvency)
    {
        $this->attributes['solvency'] = $solvency;
    }

    public function diagnostic()
    {
        return $this->hasOne(Diagnostic::class);
    }

    public static function validate(Request $request)
    {
        return Validator::make($request->all(), [
            'leverage'=>'required|string|max:500',
            'growth'=>'required|string|max:500',
            'eficiency'=>'required|string|max:500',
            'liquidity'=>'required|string|max:500',
            'cost_effectiveness'=>'required|string|max:500',
            'solvency'=>'required|string|max:500'
        ]);
    }
}