<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import SuggestedImage from '../Components/CustomComponents/ImageViewComponents/SuggestedImage.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    images: Object
});

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
            <div class="w-full md:w-2/3 flex gap-10 flex-wrap justify-center items-center bg-pink-400">


                

                <div class=" mb-3 bg-red-600 w-1/4" >
                    <figure>
                        <img style="object-fit: cover;" src="https://placeimg.com/720/410/arch" alt="Shoes" />
                    </figure>
                    
            
                </div>

                <div class=" mb-3 bg-red-600 w-1/4" >
                    <figure>
                        <img style="object-fit: cover;" src="https://placeimg.com/720/410/arch" alt="Shoes" />
                    </figure>
                    
            
                </div>

                <div class=" mb-3 bg-red-600 w-1/4" >
                    <figure>
                        <img style="object-fit: cover;" src="https://placeimg.com/720/410/arch" alt="Shoes" />
                    </figure>
                    
            
                </div>

                <div class=" mb-3 bg-red-600 w-1/4" >
                    <figure>
                        <img style="object-fit: cover;" src="https://placeimg.com/720/410/arch" alt="Shoes" />
                    </figure>
                    
            
                </div>

                <div class=" mb-3 bg-red-600 w-1/4" >
                    <figure>
                        <img style="object-fit: cover;" src="https://placeimg.com/720/410/arch" alt="Shoes" />
                    </figure>              
            
                </div>

            </div>
           
        </div>
    </main>
</template>
