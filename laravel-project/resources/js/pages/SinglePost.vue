<template>
	<div class="container">
	   <h3>{{ post.title}}</h3>
	   
		<p>
			{{post.content}}
		</p>
	</div>
   
   </template>
   
<script>  
	 export default{
	  name: 'SinglePost',
	  data(){
		return{
			post: null
		};
	  },
	  mounted(){
		axios.get(
			'http://127.0.0.1:8000/api/posts/' 
			+ 
			this.$route.params.slug)
		.then((response)=>{
			this.post = response.data.results;
		});
		
	  }	
	 }
</script>