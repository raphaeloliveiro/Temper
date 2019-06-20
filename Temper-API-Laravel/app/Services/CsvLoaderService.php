<?php

namespace App\Services;

use App\Services\Interfaces\LoadableInterface;
use League\Csv\Reader;

class CsvLoaderService implements LoadableInterface
{
	/**
	 *
	 *
	 * @param  string 	$filepath	The CSV file.
	 * @return void
	 */
	/**
	 * Load the given CSV file.
	 *
	 * @param  string  $filepath  The file path
	 * @param  integer $offset    Offset
	 * @param  string  $delimeter Delimeter
	 * @return array              The loaded data.
	 */
	public function load( string $filepath, string $open_mode = 'r', int $offset = 0, string $delimeter = ';' )
	{
        $csv = Reader::createFromPath( $filepath, $open_mode );
        $csv->setHeaderOffset( $offset );
		$csv->setDelimiter( $delimeter );

		return $csv;
	}
}
