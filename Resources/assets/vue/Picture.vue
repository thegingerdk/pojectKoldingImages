<template>
    <div class="picture col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <div class="card" :class="{'my-images' : remove}">
            <a v-if="remove" class="delete-btn" @click.prevent="removeImage" href="#"><i class="fa fa-trash"></i></a>
            <img @click="openLarge" class="card-img-top" :src="thumb" alt="Card image cap">
            <div class="card-body" v-if="!remove">
                <div class="btn-group btn-group-justified" role="group" aria-label="Basic example">
                    <a href="#"
                       @click.prevent="rate(0)"
                       class="btn btn-default disliked"
                       :class="{'disabled' : disabled && rated.rating != 0, 'rated rated-this' : rated.rating == 0}"
                       :disabled="disabled">
                        <i class="fa fa-thumbs-down"></i> <br> {{ picture.dislikes }}
                    </a>
                    <a href="#"
                       @click.prevent="rate(1)"
                       class="btn btn-default liked"
                       :class="{'disabled' : disabled && rated.rating != 1, 'rated rated-this' : rated.rating == 1}"
                       :disabled="disabled">
                        <i class="fa fa-thumbs-up"></i> <br> {{ picture.likes }}
                    </a>
                    <a href="#"
                       @click.prevent="rate(2)"
                       class="btn btn-default favored"
                       :class="{'disabled' : disabled && rated.rating != 2, 'rated rated-this' : rated.rating == 2}"
                       :disabled="disabled">
                        <i class="fa fa-heart"></i> <br> {{ picture.favored }}
                    </a>
                    <a href="#"
                       @click.prevent="rate(3)"
                       class="btn btn-default stared"
                       :class="{'disabled' : disabled && rated.rating != 3, 'rated rated-this' : rated.rating == 3}"
                       :disabled="disabled">
                        <i class="fa fa-star"></i> <br> {{ picture.stared }}
                    </a>
                </div>
                <hr>
                <h4>{{ picture.caption }}</h4>
            </div>
        </div>
    </div>
</template>
<script>
    import {EventBus} from '../js/app.js';

    export default {
        props: ['uid', 'authenticated', 'picture', '_rated', 'remove'],
        data() {
            return {
                thumb: '',
                disabled: false,
                rated: {
                    rating: null,
                    pictureID: this.picture.ID,
                    userID: this.uid
                }
            }
        },
        mounted() {
            this.rated.rating = this._rated ? this._rated.rating : null;

            this.thumb       = `http://web1.pete334y.iba-abakomp.dk/assets/images/${this.picture.userID}/thumb__${this.picture.image}`;
            this.picture.src = `http://web1.pete334y.iba-abakomp.dk/assets/images/${this.picture.userID}/medium__${this.picture.image}`;

            this.disabled = this.authenticated && this.picture.userID == this.uid || this.rated.rating;
        },
        methods: {
            openLarge() {
                EventBus.$emit('open-large-image', this.picture);
            },
            removeImage() {
                EventBus.$emit('delete-image', this.picture);
            },
            rate(val) {
                axios.post(`/api/rate?pid=${this.picture.ID}&rating=${val}`).then(($response) => {
                    let $r = $response.data.rated == true

                    this.disabled     = $r;
                    this.rated.rating = $r ? val : null;
                    if($r){
                        if (val == 0) this.picture.dislikes++;
                        else if (val == 1) this.picture.likes++;
                        else if (val == 2) this.picture.favored++;
                        else if (val == 3) this.picture.stared++;
                    }else {
                        if (val == 0) this.picture.dislikes--;
                        else if (val == 1) this.picture.likes--;
                        else if (val == 2) this.picture.favored--;
                        else if (val == 3) this.picture.stared--;
                    }
                });
            }
        },
    }
</script>