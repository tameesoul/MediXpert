<?php

namespace App\Models;

use App\Rules\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Category extends Model
{
 use HasFactory , SoftDeletes;

    protected $guarded =[];

        public function ScopeFilter(Builder $builder , $filter)
        {
            $builder->when($filter['name']??false,function($builder,$value){
                    $builder->where('name','LIKE',"%{$value}%");
            });
            $builder->when($filter['status']??false,function($builder,$value){
                    $builder->where('status','=',"{$value}");
            });
        }

        public function parents()
        {
            return $this->belongsTo(Category::class,'parent_id','id')
            ->withDefault([
                'name'=>'-'
            ]);
        }
        public function child()
        {
            return $this->hasMany(Category::class,'parent_id','id');
        }

        public function products()
        {
            return $this->hasMany(Product::class);
        }
    public static function rules($id =0)
    {
        return [
            'name'=>[
                'required', 'min:3', 'max:250', 'unique:categories,name,'. $id,

                new Filter(['laravel,php'])
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
