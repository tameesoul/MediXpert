@extends('layouts.dashboard')
@section('content')
@section('title', 'Edit Profile Page')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit Profile</li>
@endsection

<x-alert type="success" />
<form action="{{ route('dashboard.profile.update') }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="form-row">
        <div class="col-md-6">
            <x-form.input name="first_name" label="First Name" :value="$user->profile ? $user->profile->first_name : ''" />
        </div>
        <div class="col-md-6">
            <x-form.input name="last_name" label="Last Name" :value="$user->profile ? $user->profile->last_name : ''" />
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6">
            <x-form.input name="birth_date" type="date" label="Birth Date" :value="$user->profile ? $user->profile->birth_date : ''" />
        </div>
        <div class="col-md-6">
            <x-form.radio name="gender" label="Gender" :options="['m' => 'male', 'f' => 'female']" :checked="$user->profile ? $user->profile->gender : ''" />
        </div>
    </div>

    <div class="form-row">
        <div class="col-md-4">
            <x-form.input name="street_address" label="Street Address" :value="$user->profile ? $user->profile->street_address : ''" />
        </div>
        <div class="col-md-4">
            <x-form.input name="city" label="City" :value="$user->profile ? $user->profile->city : ''" />
        </div>
        <div class="col-md-4">
            <x-form.input name="state" label="State" :value="$user->profile ? $user->profile->state : ''" />
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-4">
            <x-form.input name="postal_code" label="Postal Code" :value="$user->profile ? $user->profile->postal_code : ''" />
        </div>
        <div class="col-md-4">
            <x-form.select name="country" :options="$countries" label="Country" :selected="$user->profile ? $user->profile->country : ''" />
        </div>
        <div class="col-md-4">
            <x-form.select name="locale" :options="$locals" label="Locale" :selected="$user->profile ? $user->profile->locale : ''" />
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>

</form>
@endsection