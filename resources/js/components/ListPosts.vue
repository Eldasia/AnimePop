<template>
    <div>

        <div class="row" v-if="fetching === false && hasPosts === true">

            <div class="col-md-4" v-for="post in posts" :key="post.id" :id="`post-${post.id}`">
                <post :post='post' :single='false'></post>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                posts: [],
                fetching: false,
            }
        },
        mounted() {
            this.fetch()
        },
        props: {
            
        },
        methods: {
            fetch(){
                this.fetching = true
                axios.get(`/api/posts`).then(response => {
                    this.fetching = false,
                    this.posts = response.data
                }).catch(error => {
                    this.fetching = false
                })
            },
            
        },
        computed: {
            hasPosts() {
                return this.posts.length > 0
            },
        }  
    }
</script>