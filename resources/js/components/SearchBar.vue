<template>
    <form class="form-inline my-2 my-lg-0 position-relative">
        <input class="form-control mr-sm-2" type="search" placeholder="Recherche" v-model="query">
        <div class="position-absolute bg-white w-100 p-4" style="top: 40px" v-if="hasQuery">
            <span v-if="loading && hasResults === false">Recherche en cours...</span>
            <span v-else-if="loading === false && hasResults === false">Aucun résultat pour {{ query }}</span>
            <div v-else>
                <a :href="result.view_url" class="d-block" v-for="result in results" :key="result.id" > {{ result.title }} </a>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        data(){
            return {
                query: "",
                loading: false,
                results: []
            }
        },
        methods: {
            search(){
                this.loading = true
                axios.get(`/api/search?query=${this.query}`).then(response => {
                    this.loading = false
                    this.results = response.data
                }).catch(error => {
                    this.loading = false
                })
            }
        },
        computed: {
            hasQuery(){
                return this.query.length > 0
            },
            hasResults(){
                return this.results.length > 0
            }
        },
        watch: {
            query(){
                if (this.hasQuery === true){
                    this.search()
                }
            }
        }
    }
</script>