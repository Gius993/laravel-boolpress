<template>

<div class="container">
	<a href="/admin"> va ad admin</a>
	<h1>{{pageTitle}}</h1>
	<div class="row-cols-3">
		<div class="col">
			<div class="card mt-3">
				<h3>title</h3>
				<p>description</p>
			</div>
		</div>

	</div>
</div>
	
</template>

<script>
	export default {
    	name: 'Posts',
		data() {
			return{
				pageTitle: 'Le titolo'
			};
		}
	}
</script>