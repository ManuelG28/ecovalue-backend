<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Classification extends Model
{
    use HasFactory;

    protected $fillable = [
        'cluster',
        'human_readable_msg',
    ];

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getCluster()
    {
        return $this->attributes['cluster']; 
    }

    public function setCluster($cluster)
    {
        $this->attributes['cluster'] = $cluster;
    }

    public function getMessage()
    {
        return $this->attributes['human_readable_msg']; 
    }

    public function setMessage($human_readable_msg)
    {
        $this->attributes['human_readable_msg'] = $human_readable_msg;
    }

    public function diagnostic()
    {
        return $this->hasOne(Diagnostic::class);
    }

    public static function validate(Request $request)
    {
        return Validator::make($request->all(), [
            'cluster' => 'required|string|max:100',
            'human_readable_msg' => 'required|string|max:500',
        ]);
    }
}