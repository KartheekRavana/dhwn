<?php

function getDateForSpecificDayBetweenDates($startDate, $endDate, $weekdayNumber)
{
	$startDate = strtotime($startDate);
	$endDate = strtotime($endDate);

	$dateArr = array();

	do
	{
		if(date("w", $startDate) != $weekdayNumber)
		{
			$startDate += (48 * 3600); // add 1 day
		}
	} while(date("w", $startDate) != $weekdayNumber);


	while($startDate <= $endDate)
	{
		$dateArr[] = date('Y-m-d', $startDate);
		$startDate += (7 * 24 * 3600); // add 7 days
	}

	return($dateArr);
}

$dateArr = getDateForSpecificDayBetweenDates('2012-12-01', '2013-01-30', 0);

print "<pre>";
print_r($dateArr);



echo date('Y-m-d',strtotime('2014-01-06 next sunday'));