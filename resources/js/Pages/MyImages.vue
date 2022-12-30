<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ModalUploadImage from '@/Components/ModalUploadImage.vue'
import { reactive, ref } from '@vue/reactivity';
import { computed } from '@vue/runtime-core';
import axios from 'axios';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({ assets: String, images: Array});



const path_image = computed(() => {
    return `${props.assets}storage/`;
})

const attributes = ref({
    images: props.images
})
async function deleteImage(id){
    console.log(id);
    await axios.delete(`/dashboard/delete-image/${id}`);
    Inertia.reload()
}

async function toggleArchivedImageStatus(id){
    await axios.post(`/dashboard/image/${id}/toggle-image-archived-status`)
    Inertia.reload()
}

</script>

<template>
    <AppLayout title="MyImages">
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Minhas imagens - {{ attributes.teste }}
                </h2>
                <ModalUploadImage />
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex flex-wrap justify-center items-center">

                    <div :key="image.id" v-for="image in images" class=" p-5">
                        <div class="card w-96 bg-base-100 shadow-xl">
                            <figure>
                                <img :src="path_image+image.path_name.replace('public/', '')" alt="Shoes" />
                            </figure>
                            <div class="card-body">
                                <h2 class="card-title">Wow!</h2>
                                <p> {{ image.description }} </p>
                                <div class="card-actions justify-end">
                                    <button @click="toggleArchivedImageStatus(image.id)" :class="{'btn-success': image.archived}" class="btn btn-sm">
                                        {{  image.archived ? 'Desarquivar' : 'Arquivar' }}  
                                    </button>
                                    <button @click="deleteImage(image.id)" class="btn btn-sm btn-ghost">
                                        delete
                                    </button>
                                </div>
                            </div>
                        </div>

                       <!-- <img width="500" height="500" /> -->
                       
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
