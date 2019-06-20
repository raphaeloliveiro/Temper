<?php

namespace App\Services;

use App\Repositories\Interfaces\OnboardingRepositoryInterface;
use App\Services\Interfaces\FormattableInterface;

class MetricsService
{
	/**
	 * Onboarding repository.
	 *
	 * @var OnboardingRepositoryInterface
	 */
	private $onboardingRepository;

	/**
	 * The chart format service.
	 *
	 * @var FormattableInterface
	 */
	private $chartFormatService;

	/**
	 * Create a new MetricsService.
	 *
	 * @param OnboardingRepositoryInterface $onboardingRepo
	 * @param FormattableInterface $chartFormatService
	 */
	public function __construct( OnboardingRepositoryInterface $onboardingRepository, FormattableInterface $chartFormatService )
    {
        $this->onboardingRepository = $onboardingRepository;
		$this->chartFormatService 	= $chartFormatService;
    }

	/**
	 * Metrics handler.
	 *
	 * @uses getAllGroupedByWeek
	 * @uses sumCohortsProgress
	 * @uses convertProgressToPercentages
	 * @uses calculateRetention
	 * @uses generateChartableData
	 *
	 * @return array 	$formattedData	Chart compatible data.
	 */
	public function composeMetrics()
	{
		$weeklyCohorts 			= $this->onboardingRepository->getAllGroupedByWeek()->toArray();
		$cohortsProgress 		= $this->sumCohortsProgress( $weeklyCohorts );
		$progressPercentages 	= $this->convertProgressToPercentages( $cohortsProgress );
		$retentionPercentages 	= $this->calculateRetention( $progressPercentages );
		$formattedData 			= $this->chartFormatService->format( $retentionPercentages );

		return $formattedData;
	}

	/**
	 * Sum the cohorts progress(steps).
	 *
	 * @param  Collection 	$weeklyCohorts	The users grouped by weekly cohorts.
	 * @return array 		$weeklyCohorts	Cohorts progress rate.
	 */
	public function sumCohortsProgress( $weeklyCohorts )
	{
		foreach( $weeklyCohorts as $key => $cohort )
			$weeklyCohorts[$key] = array_count_values( array_column( $cohort, 'onboarding_percentage' ) );
		return $weeklyCohorts;
	}

	/**
	 * Convert the cohorts progress to percentages.
	 *
	 * @param  array 	$cohortProgress 	The cohorts progress.
	 * @return array 	$cohortProgress		The cohorts progress percentages.
	 */
	public function convertProgressToPercentages( $cohortProgress )
	{
		foreach( $cohortProgress as $ckey => $progress )
			foreach( $progress as $pkey => $progressTotal )
				$cohortProgress[$ckey][$pkey] = $progressTotal/array_sum( $progress )*100;

		return $cohortProgress;
	}

	/**
	 * Calculate the end-to-end users retention
	 * by summing the percentage of previos steps
	 * and obtaining the correct percentage of users who have been there before.
	 *
	 * @param  array 	$progressPercentages 	The cohorts progress percentages.
	 * @return array 	$progressPercentages	The end-to-end users retention percentages.
	 */
	public function calculateRetention( $progressPercentages )
	{
		foreach( $progressPercentages as $pgkey => $percentages )
		{
			$retention = array();
			krsort( $percentages );
			foreach( $percentages as $key => $percentage )
				$retention[$key] = end( $retention ) + $percentage;
			$progressPercentages[$pgkey] = $retention;
		}

		return $progressPercentages;
	}
}
