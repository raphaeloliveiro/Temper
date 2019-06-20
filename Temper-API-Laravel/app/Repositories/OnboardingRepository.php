<?php
namespace App\Repositories;

use App\Repositories\Interfaces\OnboardingRepositoryInterface;
use App\Onboarding;
use Carbon\Carbon;

class OnboardingRepository extends BaseRepository implements OnboardingRepositoryInterface
{
	/**
	 * Create a new repository and pass the model to the parent.
	 *
	 * @param  Onboarding  $model
     * @return void
	 */
    public function __construct( Onboarding $model )
    {
        parent::__construct( $model );
    }

	/**
	 * Group by weekly cohort.
	 *
	 * @return Collection
	 */
	public function getAllGroupedByWeek()
	{
		return $this->all()->groupBy(
			function( $date )
			{
				return Carbon::parse( $date->created_at )->format('W');
        	}
		)->reverse();
	}

	/**
	 * Truncate the model's table.
	 *
	 * @return void
	 */
	public function truncate()
	{
		$this->getModel()->truncate();
	}
}
