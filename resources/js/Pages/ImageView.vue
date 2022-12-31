<script setup>
import { Head, Link, Inertia } from '@inertiajs/inertia-vue3';
import SuggestedImage from '../Components/CustomComponents/ImageViewComponents/SuggestedImage.vue';
import { computed, onMounted, ref, onBeforeUnmount } from '@vue/runtime-core';
import InputComments from '../Components/CustomComponents/ImageViewComponents/InputComment.vue';
import Comments from '../Components/CustomComponents/ImageViewComponents/Comments.vue';
import ImageViewed from '../Components/CustomComponents/ImageViewComponents/ImageViewed.vue';

import { Method } from '@inertiajs/inertia';
import axios from 'axios';

const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    image: Object,
    assets: String,
    owner: Object,
    user: Object,
    comments: Object,
    followOwner: Boolean,
    imagesSuggestion: Object,
});
const path_image = computed(() => {
    return `${props.assets}storage/`;
})

const comment = ref({
    comment: ''
})


</script>

<template>
    <Head title="Home" />
    <header class="flex justify-between items-center px-10 py-5">
        <div>
            <a href="/">YouFotos.com</a>
        </div>

        <div>
            <div v-if="canLogin" class="hidden sm:block">
                <Link v-if="$page.props.user" :href="route('dashboard')" class="text-sm text-gray-700 dark:text-gray-500 underline">Ver Perfil</Link>
    
                <template v-else>
                    <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Logar</Link>
    
                    <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Registrar</Link>
                </template>
            </div>
        </div>
    </header>

    <main class="">

        <div class="flex flex-col items-center lg:justify-center lg:items-start lg:flex-row ">
            <div class="w-full md:w-2/4 flex flex-col justify-center items-center">
                <div class=" mb-3" >
                    <ImageViewed :path_image="path_image" :owner="owner" :image="image" :user="user" :following_owner="followOwner" />
                </div>

                <div  class="comments-container w-full">
                    <InputComments :user="user" :image="image" />

                    <div v-for="comment in comments" v-bind:key="comment.id" >
                        <Comments :comment="comment" :user="user" />
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/3 ">
                <div class="suggestions-container px-10 py-5 flex flex-col gap-5">
                    
                    <div v-for="image in imagesSuggestion" :key="image.id">

                        <SuggestedImage :image="image" :path_image="path_image" />
                    </div>
                

                </div>
            </div>
        </div>
    </main>
</template>

<style scoped>
  .container {
    border: 1px solid #ccc;
    overflow: auto;
  }
  .content {
    width: 100%;
    height: 100%;
  }
</style>





