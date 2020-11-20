<template>
    
    <div class="card shadow mb-4">
        <div class="card-header text-white bg-dark  d-flex justify-content-between align-items-center">
            <h6 class="mb-0">{{ post.title }}</h6>
            <span class="text-muted">{{ post.created_at_for_human }}</span>
        </div>
        <div class="card-body">
            <p><strong>{{ post.intro }}</strong></p>
            <p v-if='single === true'>{{ post.content }}</p>
            <a v-if='single === false' class="btn btn-secondary" :href="post.view_url" role="button">Lire plus &raquo;</a>
        </div>
        <div class="card-footer text-white bg-dark">
            Ecrit par <a :href="post.user.url_profile">{{ post.user.name }}</a>
        </div>
    </div>

</template>

<script>
    export default {
        mounted() {
            
        },
        props: {
            post: Object,
            single: {
                type: Boolean,
                required: false,
                default: true
            }
        },
        methods: {
            
        },
        computed: {

        }  
    }
</script>