<template>

<div class="container">
	<a href="/admin"> va ad admin</a>
	<h1>{{pageTitle}}</h1>
	<div class="row">
		<div class="col-3" v-for="post in posts" :key="id">
			<div class="card mt-3">
				<h3>{{post.title}}</h3>
				<p>{{truncateText(post.content)}}</p>
			</div>
		</div>

	</div>
</div>
	
</template>

<script>
import axios from 'axios';

	export default {
    	name: 'Posts',
		data() {
			return{
				pageTitle: 'Spade e scudi',
				posts: []
			};
		},
		methods: {
			truncateText(text){
				if(text.length > 75){
					return text.slice(0, 70) + '...';
				}
				return text;
			}
		},
		mounted(){
			axios.get('http://127.0.0.1:8000/api/posts')
			.then((response) => {
				this.posts = response.data.results;
			});
		}
	}
</script>