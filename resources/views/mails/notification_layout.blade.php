<!DOCTYPE html>
<html>
	<head>
		<!-- Styles -->
    <style>
			body{
				background: white;
				color: black;
			}

			.container{
				width:50%;
				background-color: #b4cbf0;
				text-align: center;
				padding-top: 30px;
				padding-bottom: 30px;
				text-align: center;
			}

			.content{
				display: inline-block;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="content">
				@yield('content')
			</div>
		</div>
	</body>
</html>
