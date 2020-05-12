<!DOCTYPE html>
<html>
	<head>
		<!-- Styles -->
    <style>
			.container {
			  width: 100%;
			  padding-right: 15px;
			  padding-left: 15px;
			  margin-right: auto;
			  margin-left: auto;
			}

			@media (min-width: 576px) {
			  .container {
			    max-width: 540px;
			  }
			}

			@media (min-width: 768px) {
			  .container {
			    max-width: 720px;
			  }
			}

			@media (min-width: 992px) {
			  .container {
			    max-width: 960px;
			  }
			}

			@media (min-width: 1200px) {
			  .container {
			    max-width: 1140px;
			  }
			}

			.container-fluid {
			  width: 100%;
			  padding-right: 15px;
			  padding-left: 15px;
			  margin-right: auto;
			  margin-left: auto;
			}

			.row {
			  display: -webkit-box;
			  display: flex;
			  flex-wrap: wrap;
			  margin-right: -15px;
			  margin-left: -15px;
			}

			.content{
				display: inline-block;
			}

			html {
			  font-family: sans-serif;
			  line-height: 1.15;
			  -webkit-text-size-adjust: 100%;
			  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
			}

			body {
			  margin: 0;
			  font-family: "Roboto", sans-serif;
			  font-size: 0.9rem;
			  font-weight: 400;
			  line-height: 1.6;
			  color: #212529;
			  text-align: left;
			  background-color: #f8fafc;
			  background-size: cover;
			}

			h1,
			h2,
			h3,
			h4,
			h5,
			h6 {
			  margin-top: 0;
			  margin-bottom: 0.5rem;
			}

			p {
			  margin-top: 0;
			  margin-bottom: 1rem;
			}

			h1,
			h2,
			h3,
			h4,
			h5,
			h6,
			.h1,
			.h2,
			.h3,
			.h4,
			.h5,
			.h6 {
			  margin-bottom: 0.5rem;
			  font-weight: 500;
			  line-height: 1.2;
			}

			h1,
			.h1 {
			  font-size: 2.25rem;
			}

			h2,
			.h2 {
			  font-size: 1.8rem;
			}

			h3,
			.h3 {
			  font-size: 1.575rem;
			}

			h4,
			.h4 {
			  font-size: 1.35rem;
			}

			h5,
			.h5 {
			  font-size: 1.125rem;
			}

			h6,
			.h6 {
			  font-size: 0.9rem;
			}

			small,
			.small {
			  font-size: 80%;
			  font-weight: 400;
			}

			.justify-content-center {
			  -webkit-box-pack: center !important;
			          justify-content: center !important;
			}

			.text-center {
			  text-align: center !important;
			}

			.card {
			  position: relative;
			  display: -webkit-box;
			  display: flex;
			  -webkit-box-orient: vertical;
			  -webkit-box-direction: normal;
			          flex-direction: column;
			  min-width: 0;
			  word-wrap: break-word;
			  background: rgba(210, 210, 210, 0.6);
			  background-clip: border-box;
			  border: 1px solid rgba(0, 0, 0, 0.125);
			  border-radius: 0.25rem;
			}

			.card-body {
			  -webkit-box-flex: 1;
			          flex: 1 1 auto;
			  padding: 1.25rem;
			}

			.card-header {
			  padding: 0.75rem 1.25rem;
			  margin-bottom: 0;
			  background-color: rgba(0, 0, 0, 0.03);
			  border-bottom: 1px solid rgba(0, 0, 0, 0.125);
			}

			.card-header:first-child {
			  border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
			}

			.card-header + .list-group .list-group-item:first-child {
			  border-top: 0;
			}

			.card-footer {
			  padding: 0.75rem 1.25rem;
			  background-color: rgba(0, 0, 0, 0.03);
			  border-top: 1px solid rgba(0, 0, 0, 0.125);
			}

			.card-footer:last-child {
			  border-radius: 0 0 calc(0.25rem - 1px) calc(0.25rem - 1px);
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
