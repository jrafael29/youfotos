<script>
import { Inertia } from '@inertiajs/inertia';
export default {
    props: ['user', 'image'],
    data(){
        return{
            comment: '',
            showButtons: false
        }
    },
    watch: {
        comment(){
            // this.comment.length > 0 ? this.showButtons = true : this.showButtons = false;
            this.showButtons = this.comment.length > 0;
        }
    },
    methods: {
        async sendComment(){
            const formData = new FormData();
            formData.append('user_id', this.user.id);
            formData.append('comment', this.comment);
            await this.$inertia.post(`/imagem/${this.image.id}/novo-comentario`, formData)
            // Inertia.reload()
            this.comment = '';
        },
    }

}
</script>
<template>
    <div class="w-full">
        <input v-model="comment" placeholder="Deixa seu comentario... :)" type="text" class="mb-3 bg-transparent outline-0 border-0 border-b-2 border-emerald-400 w-full">
        <div v-if="showButtons" class=" flex justify-end">
            <button class="btn btn-sm btn-ghost">cancelar</button>
            <button @click="sendComment()" class="btn btn-sm btn-success">comentar</button>
        </div>
    </div>
</template>


<style>

</style>