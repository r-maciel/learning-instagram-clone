<template>
    <!-- Our component needs to be inside div tag -->
    <div>
        <!-- Add methods to our button onclick  -->
        <button class="btn btn-primary ml-4" @click="followUser" >Follow</button>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },

        /* Add methos to our component */
        methods: {
            followUser(){
                alert('inside');
            }
        }
    }
</script>
