<template>
    <div>
        <file-pond
            ref="pond"
            accepted-file-types="image/*"
        />
    </div>
</template>

<script>
// Import filepond
import vueFilePond from 'vue-filepond';
import {setOptions} from "filepond";
// Import plugins
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
// Import styles
import 'filepond/dist/filepond.min.css';
// import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';

setOptions({
    server: {
        url: '/upload',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    },
    name: 'image',
    allowMultiple: true,
    maxFiles: 3,
})

const FilePond = vueFilePond(FilePondPluginFileValidateType);

export default {
    name: "App",
    components: {
        FilePond,
    }
}
</script>

<style scoped>

</style>
