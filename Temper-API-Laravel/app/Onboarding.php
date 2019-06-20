<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Onboarding extends Model
{
	public $timestamps = false;
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'created_at', 'onboarding_percentage', 'count_applications', 'count_accepted_applications'
    ];

	// Relations & multiplicity (i.e. user(*)<-(1)onboarding) were intentionally excluded.
	// (Since it does not make sense for this test)
}
