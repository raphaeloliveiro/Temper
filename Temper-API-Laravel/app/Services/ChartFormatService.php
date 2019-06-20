<?php

namespace App\Services;

use App\Services\Interfaces\FormattableInterface;

class ChartFormatService implements FormattableInterface
{
	/**
	 * Format the given data to be compatible with the chart.
	 * All charts start at X=0, Y=100%.
	 *
	 * @param  array 	$percentages	The retention percentages.
	 * @return array 	$dataSet		Chart compatible data.
	 */
	public function format( array $percentages )
	{
		$dataSet = [];
		foreach( $percentages as $week => $percentage )
		{
			$percentage[0x00] 	= 100;
			$progress 			= [];

			foreach( $percentage as $k => $v )
				$progress[] = [ $k, $v ];

			$dataSet[] = [ 'name' => $week, 'data' => $progress ];
		}

		return $dataSet;
	}
}
