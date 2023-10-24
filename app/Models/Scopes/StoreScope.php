<?php

namespace App\Models\Scopes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class StoreScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        function(Builder $builder){
            $user = Auth::user();
            if($user->store_id)
            {
            $builder->where('store_id','=',$user->store_id);
            }
           
        };
    }
}
