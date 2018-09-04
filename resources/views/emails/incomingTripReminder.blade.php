<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Document</title>
</head>
<body>
	<p>Dear {{$item->FirstName}},</p>
	
	<p>You have a incoming trip on {{$flight->flight_date}} at {{$flight->etd_time}} to {{$flight->flight_to}}.</p>
</body>
</html>