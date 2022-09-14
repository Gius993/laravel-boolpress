<template>
<section>
	<div class="container">
		<a href="/admin"> va ad admin</a>
		<h2>{{pageTitle}}</h2>
		<div class="row">
			<div class="col-4" v-for="post in posts" :key="post.id">
				<div class="card">
					<h3>{{post.title}}</h3>
					<p>{{truncateText(post.content)}}</p>
					<router-link class="page-link" :to="{name: 'single-post', params: {slug: post.slug}}">Guarda Dettaglio</router-link>
				</div>
			</div>
	
		</div>
	<nav aria-label="Page navigation example">
	  <ul class="pagination">
		<li class="page-item"><a class="page-link" href="#"  @click="getPosts(currentPaginationPage - 1)">Previous</a></li>
		<li class="page-item"><a class="page-link" href="#" @click="getPosts(currentPaginationPage + 1)">Next</a></li>
	  </ul>
	</nav>
	</div>
</section>
	
</template>

<script>
import axios from 'axios';

	export default {
    	name: 'Posts',
		data() {
			return{
				pageTitle: 'Spade e scudi',
				posts: [],
				currentPaginationPage: 1
			};
		},
		methods: {
			truncateText(text){
				if(text.length > 75){
					return text.slice(0, 70) + '...';
				}
				return text;
			},
			getPosts(pageNumber){
				axios.get('http://127.0.0.1:8000/api/posts?', {
					params: {
						page: pageNumber
					}
				})
				.then((response) => {
					this.posts = response.data.results.data;
					this.currentPaginationPage = response.data.results.current_page;
				});
			},
		},


		mounted(){
		  this.getPosts(1);
		}
	}
</script>