<?php
function getAllDates($fromDate, $toDate)
{
	if(!$fromDate || !$toDate ) {return false;}
	 
	$dateMonthYearArr = array();
	$fromDateTS = strtotime($fromDate);
	$toDateTS = strtotime($toDate);
	for ($currentDateTS = $fromDateTS; $currentDateTS <= $toDateTS; $currentDateTS += (60 * 60 * 24))
	{
		$currentDateStr = date("Y-m-d",$currentDateTS);
		$dateMonthYearArr[] = $currentDateStr;
	}
	return $dateMonthYearArr;
}
 
$fromDate = '2012-12-21';
$toDate = '2013-01-10';
$dateArray = getAllDates($fromDate, $toDate);
 
echo  "<pre>";
print_r($dateArray);
echo "</pre>";

?>