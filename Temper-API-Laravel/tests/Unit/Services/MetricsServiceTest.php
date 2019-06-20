<?php

namespace Tests\Unit;

use Tests\TestCase;
use const METRICS_SERVICE;

class MetricsServiceTest extends TestCase
{
	/**
	 * The MetricsService
	 *
	 * @var MetricsService
	 */
	private $metricsService;

	public function setUp() : void
	{
		parent::setUp();
		$this->metricsService = $this->app->make( METRICS_SERVICE );

		$this->assertTrue( $this->metricsService !== null ); // Fail before logic creation.
	}

    /**
     * Test should sum cohorts progress.
     * (Test is meant to be 'solitary')
     *
     * @uses sumCohortsProgress
     *
     * @return void
     */
    public function testShouldSumCohortsProgress()
    {
		$testData 		= json_decode( '{"1":[{"onboarding_percentage":100},{"onboarding_percentage":55},{"onboarding_percentage":100}],"2":[{"onboarding_percentage":99},{"onboarding_percentage":40}]}', true );
		$processedData 	= $this->metricsService->sumCohortsProgress( $testData );

		$this->assertTrue( $processedData !== null ); // Fail before logic creation.

		$this->assertEquals( 1, $processedData[1][55] );
		$this->assertEquals( 2, $processedData[1][100] );
		$this->assertEquals( 1, $processedData[2][99] );
		$this->assertEquals( 1, $processedData[2][40] );

		$this->assertEquals( 2, count( $processedData[1] ) );
		$this->assertEquals( 2, count( $processedData[2] ) );
    }

	/**
     * Test should covert progress to percentage.
     * (Test is meant to be 'solitary')
     *
     * @uses convertProgressToPercentages
     *
     * @return void
     */
    public function testShouldConvertProgressToPercentages()
    {
		$testData 		= json_decode( '{"1":{"99":18,"100":11,"40":10,"95":4},"2":{"99":14,"40":20,"95":7,"100":12,"65":5,"55":2,"50":1,"35":1}}', true );
		$processedData 	= $this->metricsService->convertProgressToPercentages( $testData );

		$this->assertTrue( $processedData !== null ); // Fail before logic creation.

		$this->assertEquals( 100, $processedData[1][40]+$processedData[1][95]+$processedData[1][99]+$processedData[1][100] );
		$this->assertEquals( 100, $processedData[2][35]+$processedData[2][40]+$processedData[2][50]+$processedData[2][55]+$processedData[2][65]+$processedData[2][95]+$processedData[2][99]+$processedData[2][100] );

		$this->assertEquals( 23.255813953488, $processedData[1][40] );
		$this->assertEquals( 9.3023255813953, $processedData[1][95] );
		$this->assertEquals( 41.860465116279, $processedData[1][99] );
		$this->assertEquals( 25.581395348837, $processedData[1][100] );

		$this->assertEquals( 1.6129032258065, $this->metricsService->convertProgressToPercentages( $testData )[2][35] );
		$this->assertEquals( 32.258064516129, $this->metricsService->convertProgressToPercentages( $testData )[2][40] );
		$this->assertEquals( 1.6129032258065, $this->metricsService->convertProgressToPercentages( $testData )[2][50] );
		$this->assertEquals( 3.2258064516129, $this->metricsService->convertProgressToPercentages( $testData )[2][55] );
		$this->assertEquals( 8.0645161290323, $this->metricsService->convertProgressToPercentages( $testData )[2][65] );
		$this->assertEquals( 11.290322580645, $this->metricsService->convertProgressToPercentages( $testData )[2][95] );
		$this->assertEquals( 22.58064516129, $this->metricsService->convertProgressToPercentages( $testData )[2][99] );
		$this->assertEquals( 19.354838709677, $this->metricsService->convertProgressToPercentages( $testData )[2][100] );
    }

	/**
     * Test should calculate the retention.
     * (Test is meant to be 'solitary')
     *
     * @uses calculateRetention
     *
     * @return void
     */
    public function testShouldCalculateRetention()
    {
		$testData 		= json_decode( '{"1":{"99":41.86046511627907,"100":25.581395348837212,"40":23.25581395348837,"95":9.30232558139535}}', true );
		$processedData 	= $this->metricsService->calculateRetention( $testData );

		$this->assertTrue( $processedData !== null ); // Fail before logic creation.

		$this->assertEquals( 100, $processedData[1][40] );
		$this->assertEquals( 76.744186046512, $processedData[1][95] );
		$this->assertEquals( 67.441860465116, $processedData[1][99] );
		$this->assertEquals( 25.581395348837, $processedData[1][100] );
    }
}
