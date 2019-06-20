<?php
namespace App\Repositories;

use App\User;

class UserRepository extends BaseRepository
{
	/**
	 * Create a new repository and pass the model to the parent.
	 *
	 * @param  User  $model
     * @return void
	 */
    public function __construct( User $model )
    {
        parent::__construct( $model );
    }
}
