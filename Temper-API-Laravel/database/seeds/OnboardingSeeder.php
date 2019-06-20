<?php

use Illuminate\Database\Seeder;

class OnboardingSeeder extends Seeder
{
    /**
     * Run the Onboarding's table seeds.
     *
     * @return void
     */
    public function run()
    {
		$filepath 				= database_path( 'seeds/data/export.csv' );
		$csvLoaderService 		= resolve( 'csv-loader-service' );
		$onboardingRepository 	= resolve( 'onboarding-repository' );
		$csvData				= $csvLoaderService->load( $filepath );

		// First, let us sure the table is clean.
		$onboardingRepository->truncate();

		foreach ( $csvData as $record ) {
			$onboarding =
			[
				'user_id' 						=> $record['user_id'],
				'created_at' 					=> $record['created_at'],
				'onboarding_percentage' 		=> (int) $record['onboarding_perentage'],
				'count_applications' 			=> (int) $record['count_applications'],
				'count_accepted_applications'	=> (int) $record['count_accepted_applications']
			];

            $onboardingRepository->create( $onboarding )->save();
        };
    }
}
