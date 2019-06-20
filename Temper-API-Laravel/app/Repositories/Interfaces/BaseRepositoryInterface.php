<?php
namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    public function all();
    public function get( $id );
    public function getWhere( $key, $operator = '=', $value );
    public function create( array $attributes );
}
