<html>
<head>
	<title>Username Retrieval</title>
</head>
<body>
	<h3>{{Option::getData('site_title')}}: Retrieve Username</h3>
	<p>Your username is : <b>{{$message_body}}</b> </p>
	<p>You can login through this link : <a href="{{URL::route('login')}}">Login page</a></p>
</body>
</html>