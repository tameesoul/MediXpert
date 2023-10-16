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

    public static function rules($id = 0)
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                Rule::unique('categories', 'name')->ignore($id),
                function($attributes,$value,$fails)
                {
                    if(strtolower($value)=='poopy')
                    {
                        $fails('this name is not allowed');
                    }
                }, /// way to set custom rules

                new filters('cows') //// custom class using php artisan make:rule 
               
            ],
            
            'parent_id' => ['nullable', 'integer', 'exists:categories,id'],
            'description' => ['min:10'],
            'image' => ['file', 'mimes:jpg,bmp,png', 'max:2048'],
            'status' => ['in:active,archived']
        ];
    }
}
