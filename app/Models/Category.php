<?php

namespace App\Models;

use App\Rules\filters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','parent_id','slug','description','image','status'
    ];

    public static function rules($id =0)
    {
        return [
            'name'=>[
                'required', 'min:3', 'max:250', 'unique:categories,name,' . $id
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
