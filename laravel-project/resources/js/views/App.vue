<template>
	<div>
			<HeaderComponents />
	
		<div>

			<router-view></router-view>

		</div>
	</div>
</template>

<script>
	import HeaderComponents from '../components/HeaderComponents.vue';

	export default {
		name: 'App',
		components: {
			HeaderComponents,
		},
 
	}
</script>