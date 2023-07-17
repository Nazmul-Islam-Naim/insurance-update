<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
    	'name', 'product_category_id','product_sub_category_id','branch_id','created_by'
    ];

    //--------- product category object -------------//
    public function category()
    {
        return $this->hasOne('App\Models\ProductCategory', 'id', 'product_category_id');

    }
    //--------- product sub category object -------------//
    public function subcategory()
    {
        return $this->hasOne('App\Models\ProductSubCategory', 'id', 'product_sub_category_id');

    }

       
    //--------- branch object -------------//
    public function branch()
    {
        return $this->hasOne('App\Models\Branch', 'id', 'branch_id');

    }
    
    //--------- user object -------------//
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');

    }

    
    // scop

    public static function scopeCheckBranch($query)
    {
        $getUser = Auth::user();
        if ($getUser->role->slug != 'admin') {
            $query->where('branch_id', $getUser->branch_id);
        }
    }


}
