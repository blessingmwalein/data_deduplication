<template>
    <div class="modal fade" id="createFileModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New File</h5>
                    <button type="button" class="close" id="closeFileModal" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">File Name</label>
                            <div class="col-sm-9">
                                <input v-model="createFileForm.name" type="text" class="form-control">
                                <div class="error" v-if="createFileForm.errors.name
                                ">
                                    {{ createFileForm.errors.name }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Folder </label>
                            <div class="col-sm-9">
                                <select v-model="createFileForm.folder_id" class="form-control">
                                    <option v-for="folder in folders" :value="folder.id"> {{ folder.name }}</option>
                                </select>
                                <div class="error" v-if="createFileForm.errors.folder_id
                                ">
                                    {{ createFileForm.errors.folder_id }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">File </label>
                            <div class="col-sm-9">
                                <input type="file" @change="onFileChange" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3"></label>
                            <div class="col-sm-9">
                                <!-- disabled button on form processing -->
                                <button type="submit" @click.prevent="createFile()"
                                    class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3';
import globalMixin from "@/Mixins/global.js";


export default {
    props: ['user_id', 'folders', 'folder_id', 'file', 'isEdit'],
    data() {
        return {
            createFileForm: useForm({
                name: '',
                user_id: this.user_id,
                folder_id: this.folder_id,
                file: null
            })
        }

    },
    mixins: [globalMixin],
    methods: {

        createFile() {

            if (this.isEdit) {
                this.createFileForm.post('/user/files/' + this.file.id, {
                    preserveScroll: true,
                    onSuccess: () => {
                        document.getElementById('closeFileModal').click()
                        this.$emit('close')
                    }
                })
                return;
            } else {
                if (this.createFileForm.file == null) {
                    this.fireSnackbar('Please select file to upload', "Error", "#D82C5B", "info");
                    return;
                }
                this.createFileForm.post('/user/files', {
                    preserveScroll: true,
                    onSuccess: () => {
                        document.getElementById('closeFileModal').click()
                        this.$emit('close')
                    }
                })
            }

        },

        //create function on file change
        onFileChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createFileForm.file = files[0];
        }



    },

    //watch for file prop change
    watch: {
        file: function (val) {
            this.createFileForm.name = val.name
            this.createFileForm.folder_id = val.folder_id
        }
    }

}


</script>