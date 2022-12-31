<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import SuggestedImage from '../Components/CustomComponents/ImageViewComponents/SuggestedImage.vue';
import { computed } from '@vue/runtime-core';
import { Inertia } from '@inertiajs/inertia';


const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    images: Object,
    assets: String
});

const path_image = computed(() => {
    return `${props.assets}storage/`;
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
        <div class="flex justify-center w-full">
            <div class="w-full md:w-2/3 flex gap-10 flex-wrap justify-center items-center">

                <div v-for="image in images" :key="image.id">
                    <SuggestedImage :image="image" :path_image="path_image" />
                </div>
            </div>
           
        </div>
    </main>
</template>
