<?php

namespace App\Models;

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

    public static function rules($id = 0)
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                Rule::unique('categories', 'name')->ignore($id)
            ],
            'parent_id' => ['nullable', 'integer', 'exists:categories,id'],
            'description' => ['string', 'min:10'],
            'image' => ['file', 'mimes:jpg,bmp,png', 'max:2048'],
            'status' => ['in:active,archived']
        ];
    }
}
