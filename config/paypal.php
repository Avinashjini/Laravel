<?php
return array(
/** set your paypal credential **/
'client_id' =>'ASHEDAhanA52PuXj1VYdpBZExsAgo7JUtojtBAKNSpoS7TjX8633Ti3S7oO7-01YCboQVSfNqtlsd6Cv',
'secret' => 'EBOAUrSerJtiKbj0MLlNbOtD6nDj8rBN59bv1JpT0gY-8WiSoBWw2EE-LBJicBIl2H41YMsGsptJyKxL',
/**
* SDK configuration 
*/
'settings' => array(
/**
* Available option 'sandbox' or 'live'
*/
'mode' => 'sandbox',
/**
* Specify the max request time in seconds
*/
'http.ConnectionTimeOut' => 1000,
/**
* Whether want to log to a file
*/
'log.LogEnabled' => true,
/**
* Specify the file that want to write on
*/
'log.FileName' => storage_path() . '/logs/paypal.log',
/**
* Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
*
* Logging is most verbose in the 'FINE' level and decreases as you
* proceed towards ERROR
*/
'log.LogLevel' => 'FINE'
),
);
?>