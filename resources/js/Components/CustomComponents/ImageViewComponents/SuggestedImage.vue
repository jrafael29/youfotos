
<script >
export default {
    props: ['image', 'path_image'],
    data(){
        return {}
    },
    computed: {
        getLinkImage(){
            return `/imagem/${this.image.id}`
        }
    }
}
</script>

<template>
    <div class="flex justify-center">
        <a :href="getLinkImage">
            <figure>
                <img style="max-width:220px;max-height:135px;object-fit: cover;" :src="path_image + this.image.path_name.replace('public/', '')" alt="Shoes" />
            </figure>
        </a>
    </div>
</template>


<style>

</style>