<template>
	<div class="container" v-if="post">

	   <h3>{{ post.title}}</h3>
	   <ul>
		<li v-if="post.category">{{post.category.name}}</li>
		<li v-else> Nessuna categoria</li>
	   </ul>
		<p>
			{{post.content}}
		</p>
	</div>
   <h2 v-else>
	Pagina non caricata
   </h2>
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