<template>
	<div>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container-fluid">

				<div class="collapse navbar-collapse" id="navbarText">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<router-link to="/" class="nav-link active" aria-current="page" href="#">Home</router-link>
						</li>
						<li class="nav-item">
							<router-link to="/about" class="nav-link active" aria-current="page" href="#">About</router-link>
						</li>
						<li class="nav-item">
							<router-link to="/blog" class="nav-link active" aria-current="page" href="#">Blog</router-link>
						</li>
					
					</ul>
			
				</div>
			</div>
		</nav>
	</div>
   
   </template>
   
   <script>
	   export default{
		   name: 'HeaderComponents'
	   }
   
   </script>