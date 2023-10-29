<?php

namespace App\Models;

use App\Rules\filters;
use App\Models\Product;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name','parent_id','slug','description','image','status'
    ];

    public function products()
    {
        return $this->hasMany(Product::class,'category_id','id');
    }

    public function scopeActive(Builder $query)
    {
    return $query->where('status','=','active');
    }
    public function scopeFilter(Builder $query, $filters)
    {
        $query->when(isset($filters['name']), function ($builder) use ($filters) {
            $builder->where('name', 'LIKE', '%' . $filters['name'] . '%');
        });
        
        $query->when(isset($filters['status']), function ($builder) use ($filters) {
            $builder->where('status', '=', $filters['status']);
        });
    
        // if (isset($filters['name'])) {
        //     $query->where('name', 'LIKE', "%{$filters['name']}%");
        // }
        
        // if (isset($filters['status'])) {
        //     $query->where('status', '=', $filters['status']);
        // }

        /// both ways are right but use a when is better and more clean;
    }

    public static function rules($id =0)
    {
        return [
            'name'=>[
                'required', 'min:3', 'max:250', 'unique:categories,name,' . $id,

                // function($attribute,$value,$fails)
                // {
                //     if(strtolower($value) == 'kill')
                //     {
                //         return $fails('this name is not allowed '); //// use "php artisan make:filter" to set class for rules
                //     }
                // },
                new filters(['kill','die','isreal']),
            ],
            'parent_id'=>[
                'nullable','int','exists:categories,id'
            ],
            'image'=>[
                'image'
            ],
            'Status'=>[
                'in:active,archived'
            ]
            ];
    }
}
