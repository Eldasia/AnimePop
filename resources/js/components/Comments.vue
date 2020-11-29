<template>
    <div class="card shadow mb-4">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-item-center">
            <div>Commentaires <span class="badge badge-dark">{{ comments.length }}</span></div>
            <a class="btn btn-dark btn-sm" href="#" @click.prevent='switchSort()'>{{ sortedMessage }}</a>
        </div>

        <div class="card-body" v-if="fetching === false && hasComments === true" >
            <div :id="`comment-${comment.id}`" v-for="comment in sortedComments" :key="comment.id">
                <p class="d-flex justify-content-between">
                    <strong><a :href="comment.user.url_profile">{{ comment.user.name }}</a></strong>
                    <button @click='remove(comment)' class="btn btn-danger btn-sm" v-if="canManage">
                        Supprimer le commentaire
                    </button>
                </p>
                <p>{{ comment.message }}</p>
                <hr>
            </div>
        </div>

        <div class="alert alert-danger mb-0" v-else>Il n'y a pas de commentaire, soyez le premier à en ajouter un !</div>

        <div class="card-footer text-white bg-secondary">
        
            <div class="alert alert-warning" v-if="$root.user === null">
                <a href="/login">Connectez-vous</a> pour poster un commentaire.
            </div>
        
            <div v-else>
                <div class="form-group">
                    <textarea class="form-control" 
                            placeholder="Votre commentaire..." 
                            v-model="comment" 
                            @keyup.shift.enter="add()"
                            :disabled="adding ===  true"
                            required></textarea>
                </div>
                <button type="button" class="btn btn-dark" @click.prevent='add()' v-if='adding === false'>Envoyer</button>
                <button type="button" class="btn btn-dark" disabled v-else>Envoi en cours...</button>
            </div>
        </div>
    </div> 
</template>

<script>
    export default {
        data(){
            return {
                fetching: false,
                adding: false,
                comments: [],
                sort: 'asc',
                comment: "",
            }
        },
        mounted() {
            this.fetch()
        },
        props: {
            type: {
                type: String,
                required: true,
                validator: (value) => ['post', 'product', 'anime'].indexOf(value) != -1
            },
            id: {
                type: Number,
                required: true
            }
        },
        methods: {
            fetch(){
                this.fetching = true
                axios.get(`/api/comments/${this.type}/${this.id}`).then(({data, status})=> {
                    this.fetching = false;
                    this.comments = data.data;
                    this.showSelected();
                }).catch(error => {
                    this.fetching = false
                })
            },
            add(){
                this.adding = true
                axios.post(`/api/comment/${this.commentable.id}`, {
                    message: this.comment,
                }).then(response => {
                    this.adding = false
                    this.comment = ""
                    this.fetch()
                }).catch(error => {
                    this.adding = false
                })
            },
            remove(comment){
                axios.delete(`/api/comment/${this.commentable.id}/${comment.id}`).then(response => {
                    this.fetch()
                }).catch(error => alert("Impossible de supprimer le commentaire :'("))
            },
            switchSort(){
                this.sort = this.sort == "asc" ? "desc" : "asc"
            },
            showSelected(){
                this.$nextTick(() => {
                    let selected = window.location.hash
                    if (selected.length > 1){
                        let comment = document.querySelector(selected)
                        comment.classList.add("bg-info") 
                    }
                })

            }
        },
        computed: {
            canManage() {
                return this.$root.user != null && this.$root.user.id == this.user.id
            },
            hasComments(){
                return this.comments.length > 0
            },
            sortedComments(){
                return this.comments.slice().sort((a, b) => {
                    if(this.sort == "asc") {
                        return a.id - b.id
                    }
                    return b.id - a.id
                })
            },
            sortedMessage(){
                return this.sort == "asc" ? "Ordre croissant" : "Ordre décroissant"
            }
        }  
    }
</script>