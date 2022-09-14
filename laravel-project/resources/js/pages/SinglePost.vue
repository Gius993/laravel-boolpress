<template>
	<div class="container">
	   <h3>Pagina dettaglio</h3>
	   {{ $route.params.slug }}
	
	</div>
   
   </template>
   
<script>  
	 export default{
		  name: 'SinglePost',
   
	 }
</script>