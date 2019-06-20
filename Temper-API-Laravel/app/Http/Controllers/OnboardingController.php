<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MetricsService;

class OnboardingController extends Controller
{
	/**
	 * The metrics service.
	 *
	 * @var MetricsService
	 */
    private $metricsService;

	/**
	 * Create the controller.
	 *
	 * @param AppServicesMetricsService $metricsService
	 */
    public function __construct( MetricsService $metricsService )
    {
        $this->metricsService  = $metricsService;
    }

	/**
	 * Route index response.
	 *
	 * @return 	JSON	Chart compatible data for front-end clients.
	 */
	public function index()
    {
		return response()->json( $this->metricsService->composeMetrics(), 201 );
    }
}
