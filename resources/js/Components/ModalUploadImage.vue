<template>
    <div>
        <label for="modal-upload" class="btn">Nova Imagem</label>
        <input type="checkbox" id="modal-upload" class="modal-toggle" />
        <div class="modal">
            <div class="modal-box w-11/12 max-w-5xl">
                <div class="flex justify-center">
                    <form @submit.prevent="upload" >

                        <div class="mb-4 flex justify-center">
                            <label class="btn" for="image">
                                {{ imageUrl ? 'Escolher Outra Imagem' : 'Selecionar Imagem'  }}
                            </label>
                            <input @change="previewImage" class="hidden" type="file" ref="imageInput" id="image" name="image">
                        </div>

                        <div class="flex justify-evenly items-center w-full gap-5">
                            <img v-if="imageUrl" height="250" width="250" :src="imageUrl" alt="Pré-visualização da imagem" />
                            <div>
                                <textarea v-if="imageUrl" ref="description" class="textarea textarea-accent" :placeholder="textAreaPlaceholder"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-action flex justify-center">
                    <button @click="upload()" class="btn btn-success">Feito</button>
                    <label @click="() => this.imageUrl = ''" ref="fecharModal" for="modal-upload" class="btn btn-ghost">Fechar!</label>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            imageUrl: '',
            textAreaPlaceholder: 'Descrição da imagem...'
        }
    },
    methods: {
    async upload() {

        const formData = new FormData();
        formData.append('image', this.$refs.imageInput.files[0]);
        formData.append('description', this.$refs.description.value);
            
        const res = await this.$inertia.post('/dashboard/nova-imagem', formData)

        this.imageUrl = '';
        this.$refs.fecharModal.click();
    },
    previewImage() {

        const file = this.$refs.imageInput.files[0];
        const reader = new FileReader();

        reader.onload = (event) => {
            this.imageUrl = event.target.result;
        };

        reader.readAsDataURL(file);
    },

  },
}
</script>

<style>

</style>