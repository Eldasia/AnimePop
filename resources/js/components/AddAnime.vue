<template>
    <div>
        <form>
            <div class="form-group">
                <label for="addAnime">Entrez le nom d'un animé :</label>
                <input type="text" 
                    id="addAnime"
                    class="form-control" 
                    v-model="query">
            </div>
            <button @click.prevent='search()' :disabled="query.length < 3" role="button" class="btn btn-dark">Chercher</button>
        </form>

        <div v-if="hasquery">
            <span v-if="loading && hasResults === false">Recherche en cours</span>
            <div class="d-flex m-4" v-if="loading === false && hasResults === true">
                <div :id="`anime-${anime.mal_id}`" v-for="anime in animes" :key="anime.mal_id">
                    <img :src='anime.image_url' alt='Image générée par faker' height=100px width=100px class="pr-1"/>
                    <div>
                        <h4><p>{{anime.title}}</p></h4>
                        <p><span class="text-muted">{{ anime.type }}</span><span class="badge badge-secondary m-2">{{anime.episodes}}</span></p>
                        <p>{{anime.synopsis}}</p>
                    </div>
                    <button class="btn btn-dark" @click.prevent='add(anime)' :disabled="$root.user === null">Ajouter cet animé</button>
                </div>
            </div>
        </div>
        <div class="p-3 mb-2 text-muted text-center font-italic font-weight-light" v-else>
            Cherchez un animé pour l'ajouter!
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                loading: false,
                adding: false,
                query: "",
                animes: [],
                error: ""
            }
        },
        methods: {
            search(){
                this.loading = true
                axios.post(`/api/animes/search`, {
                    query: this.query
                }).then(response => {
                    this.loading = false,
                    this.animes = response.data
                }).catch(error => {
                    this.loading = false
                })
            },
            add(anime){
                this.adding = true
                axios.post(`/api/animes/store`, {
                    mal_id: anime.mal_id
                }).then(response => {
                    this.query = ""
                    this.animes = []
                    this.adding = false
                }).catch(error => {
                    this.adding = false
                })
            }
        },
        computed: {
            hasquery(){
                return this.query.length > 0
            },
            hasResults(){
                return this.animes.length > 0
            }
        }
    }
</script>