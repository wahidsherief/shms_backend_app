<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Business extends Model
{
    use HasFactory;
    protected $fillable = ['name','business_type_id','email'];

    public function type() { 
        return $this->belongsTo(BusinessType::class, 'business_type_id'); 
    }

    public function products() { 
        return $this->hasMany(Product::class); 
    }
}
