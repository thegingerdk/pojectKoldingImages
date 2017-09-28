<template>
    <div class="wrap">
        <div @keyup.esc="close" class="large-image" v-show="picture && !remove" @click="close">
            <img :src="picture.src" alt="">
        </div>
        <div class="container">
            <div class="row">
                <s-picture :remove="remove" :_rated="checkIfRated(picture.ID)" :uid="uid" :authenticated="authenticated" v-for="picture in pictures" :picture="picture" :key="picture.ID"></s-picture>
            </div>
        </div>
    </div>
</template>

<script>
    import {EventBus} from '../js/app.js';

    export default {
        props: ['uid', 'authenticated', 'remove'],
        data() {
            return {
                pictures: [],
                picture: false,
                ratings: []
            }
        },
        mounted() {
            this.getImages();

            EventBus.$on('open-large-image', this.open);
            EventBus.$on('rate', this.rate);
            EventBus.$on('delete-image', this.deleteImage);
        },
        methods: {
            getImages() {
                let $url = this.remove ? '?my-images' : '';
                axios.get('/api/images' + $url).then(($response) => {
                    this.pictures = $response.data.pictures;
                    this.ratings  = $response.data.ratings;
                });
            },
            deleteImage(picture) {
                axios.get(`/api/picture/delete?pid=${picture.ID}`).then(($response) => {
                    this.pictures = $response.data.pictures;
                });
            },
            checkIfRated(pid) {
                for (let i = 0; i < this.ratings.length; i++) {
                    if (this.ratings[i].pictureID == pid) {
                        return this.ratings[i];
                    }
                }
                return false;
            },
            close() {
                document.getElementById('root').classList.remove("opened-image");
                this.picture = false;
            },
            open(picture) {
                document.getElementById('root').classList.add("opened-image");
                this.picture = picture;
            }
        },
    }
</script>