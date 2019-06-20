<?php
namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
	/**
	 * The target model.
	 *
	 * @var mixed
	 */
    private $model;

	/**
	 * Create a new repository.
	 *
	 * @param mixed  $model
     * @return void
	 */
    public function __construct( Model $model )
	{
        $this->model = $model;
    }

	/**
	 * Get all of the items.
	 *
	 * @return array
	 */
    public function all()
    {
        return $this->model->all();
    }

	/**
	 * Get item by id.
	 *
	 * @param  int 	$id
	 * @return Illuminate\Database\Eloquent\Model
	 */
	public function get( $id )
    {
        return $this->model->find( $id );
    }

	/**
	 * Filter items by the given key value pair and return a collection of models.
	 *
	 * @param  string 		$key
	 * @param  mixed 		$operator
	 * @param  mixed 		$value
	 * @return Collection
	 */
    public function getWhere( $key, $operator = '=', $value )
    {
        return $this->model->where( $key, $operator, $value );
    }

	/**
	 * Create a new model and return the instance.
	 *
	 * @param  array  $attributes
	 * @return Illuminate\Database\Eloquent\Model
	 */
	public function create( array $attributes )
	{
		return $this->model->create( $attributes );
	}

	/**
	 * Get the model.
	 *
	 * @return Illuminate\Database\Eloquent\Model
	 */
	public function getModel()
	{
		return $this->model;
	}
}
