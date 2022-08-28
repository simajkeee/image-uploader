<template>
    <div>
        <file-pond
            name="image"
            ref="pond"
            allow-multiple="true"
            max-files="3"
            server="/upload"
            accepted-file-types="image/*"
        />
    </div>
</template>

<script>
import vueFilePond from 'vue-filepond';

// Import plugins
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';


// Import styles
import 'filepond/dist/filepond.min.css';
// import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';

const FilePond = vueFilePond(FilePondPluginFileValidateType);

export default {
    name: "App",
    components: {
        FilePond,
    },
    methods: {
        handleFilePondInit: function () {
            console.log('FilePond has initialized');
            this.$refs.pond.getFiles();
        },
    },
}
</script>

<style scoped>

</style>
