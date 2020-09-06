<template>
    <!-- Our component needs to be inside div tag -->
    <div>
        <!-- Add methods to our button onclick  -->
        <button class="btn btn-primary ml-4" @click="followUser" >Follow</button>
    </div>
</template>

<script>
    export default {
        /* Recieving the arguments for our component */
        props: ['userId'],

        mounted() {
            console.log('Component mounted.')
        },

        /* Add methos to our component */
        methods: {
            followUser(){
                /* Axios is http client that comes installed, the method and the url we need */
                axios.post(`/follow/${this.userId}`)
                .then(response => {
                    alert(response.data)
                });
            }
        }
    }
</script>
