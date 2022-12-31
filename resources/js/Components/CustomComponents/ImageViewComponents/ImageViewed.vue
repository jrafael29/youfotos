<script>
import axios from 'axios';
import { Inertia } from '@inertiajs/inertia';

export default {
    props: ['path_image', 'image', 'owner', 'user', 'following_owner'],
    data(){
        return{

        }
    },
    methods: {
        async followImageOwner (image) {
            const res = await axios.post(`/imagem/${image}/seguir-dono`)
            Inertia.reload()
        },
        async unfollowImageOwner(image){
            const res = await axios.post(`/imagem/${image}/deixar-de-seguir-dono`)
            Inertia.reload()
            // console.log(res)
        }
    },
    computed: {
        ownerProfile(){
            return this.owner.owner_profile_path ?? this.owner.owner_profile_url;

        },
        userLoggedIsOwnerOfImage  () {
            return this.user.id === this.image.user_id
        }
    }
}
</script>
<template>
    <div>
        <div style="max-width:720px;max-height:410px;" class="image-container  flex justify-center items-center w-100">
            <img style="max-height:410px;" :src="path_image+image.path_name.replace('public/', '')" />
        </div>
        <div style="max-width:550px" class="px-2 py-2">
            <p class="text-justify">
                            {{ image.description ?? '' }}
            </p>
        </div>
        <div class="py-3 flex">
                        
            <div class="avatar px-1 mr-1">
                <div class="w-12 rounded-full">
                    <img :src="ownerProfile" />
                </div>
            </div>

            <div class="info flex items-center gap-5">
                <div>
                    <span> {{ owner.name }} </span>
                </div>
                <div v-if="!userLoggedIsOwnerOfImage">
                    <div v-if="following_owner">
                        <button @click="unfollowImageOwner(image.id)" class="opacity-50 btn btn-sm btn-outline btn-warning">Seguindo</button>

                    </div>
                    <div v-else>
                        <button @click="followImageOwner(image.id)" class="opacity-50 btn btn-sm btn-success">Seguir</button>
                    </div>
                </div>
            </div>


        </div>
    </div>
</template>

<style>

</style>