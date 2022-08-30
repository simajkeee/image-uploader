<template>
    <div class="row">
        <div class="col-12">
            <file-pond
                ref="pond"
                accepted-file-types="image/jpg, image/jpeg, image/png"
                maxFileSize="1900KB"
                @processfile="processFile"
            />
        </div>
        <div class="col-4 mb-2" v-for="(image, index) in images" :key="index">
            <img :src="`/storage/images/`+ image" class="img-fluid"/>
        </div>
    </div>
</template>

<script>
import axios from "axios";

// Import filepond
import vueFilePond from 'vue-filepond';
import {setOptions} from "filepond";
// Import plugins
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
// Import styles
import 'filepond/dist/filepond.min.css';

let serverMsg = {}
setOptions({
    server: {
        process: {
            url: '/upload',
            onerror: (response) => {
                serverMsg = JSON.parse(response);
            },
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        }
    },
    labelFileProcessingError: () => {
        return serverMsg.error;
    },
    name: 'image',
    allowMultiple: true,
    maxFiles: 3,
    maxParallelUploads: 3,
})

const FilePond = vueFilePond(FilePondPluginFileValidateType, FilePondPluginFileValidateSize);

export default {
    name: "App",
    components: {
        FilePond,
    },
    data() {
        return {
            images: []
        }
    },
    created() {
        axios.get('/images')
        .then(res => {
            this.images = res.data
        }).catch(err => {
            console.log(err)
        })
    },
    methods: {
        processFile(err, file) {
            if (err) {
                console.log(err);
                return;
            }
            this.images.unshift(file.serverId);
        },
    }
}
</script>

<style scoped>

</style>
