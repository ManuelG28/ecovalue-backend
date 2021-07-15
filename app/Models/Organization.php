<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
    ];

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getName()
    {
        return $this->attributes['name'];
    }

    public function setName($name)
    {
        $this->attributes['name'] = $name;
    }
    
    public function setUserId($id)
    {
        $this->attributes['user_id'] = $id;
    }

    public function getUserId()
    {
        return $this->attributes['user_id'];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function diagnostic()
    {
        return $this->hasMany(Diagnostic::class);
    }

    public static function validate(Request $request)
    {
        return Validator::make($request->all(), [
            'name' => 'required|string|max:200',
        ]);
    }
}
