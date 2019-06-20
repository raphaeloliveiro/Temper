<?php

namespace Tests\Unit;

use Tests\TestCase;

class OnboardingTest extends TestCase
{
    /**
     * Just for the sake of formality.
     * No, not going to test trivial codes.
     *
     * @return void
     */
    public function testShouldCreateOnboarding()
    {
		$this->assertTrue( ( $this->app->make( 'App\Onboarding' ) !== null ) ); // Fail before logic creation.
    }
}
