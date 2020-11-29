<template>

    <div v-if="fetching === false && hasAnimes === true" >

        <div class="d-flex m-4" v-for="anime in animes" :key="anime.id" :id="`anime-${anime.id}`">

            <img class="pr-1" :src='anime.img_url' alt='Image générée par faker' height=100px width=100px />
            <div>
                <h4><a :href="anime.view_url">{{ anime.title }}</a></h4>
                <p><span class="text-muted">{{ anime.type }}</span><span class="badge badge-secondary m-2">{{ anime.episodes }}</span></p>
                <p>{{ anime.synopsis }}</p>
            </div>

        </div>

    </div>

</template>

<script>
    export default {
        data(){
            return {
                animes: [],
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
                axios.get(`/api/animes`).then(response => {
                    this.fetching = false,
                    this.animes = response.data
                }).catch(error => {
                    this.fetching = false
                })
            },
        },
        computed: {
            hasAnimes() {
                return this.animes.length > 0
            },
        }  
    }
</script>