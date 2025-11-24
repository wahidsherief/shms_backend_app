<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function components() { 
        return $this->hasMany(Component::class); 
    }

    public function predictions() { 
        return $this->hasMany(Prediction::class); 
    }

    public function business() { 
        return $this->belongsTo(Business::class); 
    }

    public function salesHistories() { 
        return $this->hasMany(SalesHistory::class); 
    }
}
