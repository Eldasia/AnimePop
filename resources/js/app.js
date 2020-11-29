require('./bootstrap');

window.Vue = require('vue');

Vue.component('search-bar', require('./components/SearchBar.vue').default);
Vue.component('comments', require('./components/Comments.vue').default);
Vue.component('list-animes', require('./components/ListAnimes.vue').default);
Vue.component('add-anime', require('./components/AddAnime.vue').default);
Vue.component('post', require('./components/Post.vue').default);
Vue.component('list-posts', require('./components/ListPosts.vue').default);
Vue.component('post', require('./components/Post.vue').default);

const app = new Vue({
    el: '#app',
    data() {
        return {
            user: window.Laravel.user
        }
    }
});