<template>
    <!-- Our component needs to be inside div tag -->
    <div>
        <!-- Add methods to our button onclick, add customized text  -->
        <button class="btn btn-primary ml-4" @click="followUser" v-text="buttonText"></button>
    </div>
</template>

<script>
    export default {
        /* Recieving the arguments for our component */
        props: ['userId', 'follows'],

        mounted() {
            console.log('Component mounted.')
        },

        data: function(){
            return {
                status: this.follows
            }
        },

        /* Add methos to our component */
        methods: {
            followUser(){
                /* Axios is http client that comes installed, the method and the url we need */
                axios.post(`/follow/${this.userId}`)
                .then(response => {
                    /* Refresh the interface, refresh the button text in the response */
                    this.status = ! this.status;
                    console.log(response.data);
                })
                .catch(errors => {
                    if (errors.response.status == 401){
                        window.location = '/login';
                    }
                })
            }
        },

        /* Changing text with vue */
        computed: {
            buttonText(){
                return (this.status) ? 'Unfollow' : 'Follow';
            }
        }
    }
</script>
