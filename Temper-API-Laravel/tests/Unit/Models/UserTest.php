<?php

namespace Tests\Unit;

use Tests\TestCase;

class UserTest extends TestCase
{
	/**
     * Just for the sake of formality.
     * No, not going to test trivial codes.
     *
     * @return void
     */
    public function testShouldCreateUser()
    {
		$this->assertTrue( ( $this->app->make( 'App\User' ) !== null ) ); // Fail before logic creation.
    }
}
