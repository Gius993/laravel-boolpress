
<template>
    <div class="container">
        <h1>Contattaci</h1>

        <form @submit.prevent="sendMessage">
            <div class="mb-3">
                <label for="user-name" class="form-label">Nome</label>
                <input v-model="userName" type="text" class="form-control" id="user-name">
            </div>

            <div class="mb-3">
                <label for="user-email" class="form-label">Email</label>
                <input v-model="userEmail" type="email" class="form-control" id="user-email">
            </div>

            <div class="mb-3">
                <label for="user-message" class="form-label">Messaggio</label>
                <textarea v-model="userMessage" class="form-control" id="user-message" rows="10"></textarea>
            
            </div>

            <input type="submit" class="btn btn-primary" :disabled="sending">
        </form>
    </div>
</template>




<script>
export default{
	name: 'ContactPage',
	data(){
		 return  {
            userName: '',
            userEmail: '',
            userMessage: '',
           
		 }
	},
	
}


</script>