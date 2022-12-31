<script>
import { Inertia } from '@inertiajs/inertia';
export default {
    props: ['comment', 'user'],
    data(){
        return {

        }
    },
    computed: {
        userLoggedIsOwnerOfComment(){
            return this.comment.user.id == this.user.id
        }
    },
    methods: {
        async deleteComment(){
            if(this.userLoggedIsOwnerOfComment){
                await this.$inertia.delete(`/imagem/${this.comment.image.id}/excluir-comentario/${this.comment.id}`)
                Inertia.reload();
            }
        }
    }
}
</script>

<template>
    <div  class=" my-3 flex items-center">

        <div class="w-1/6 flex flex-col items-center justify-center">
            <div class="avatar px-1 mr-1">
                <div class="w-12 rounded-full">
                    <img :src="comment.user.profile_photo_path ?? comment.user.profile_photo_url" />
                </div>
            </div>
            <div class="">
                {{ comment.user.name }}
            </div>
        </div>

        
        <div class="w-4/6">
            {{ comment.comment }}
        </div>

        <div class="w-1/6" v-if="userLoggedIsOwnerOfComment">
            <button @click="deleteComment()" class="btn btn-sm btn-ghost ">Excluir comentario</button>
        </div>


    </div>
</template>



<style>

</style>