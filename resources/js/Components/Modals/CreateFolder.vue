<template>
    <div class="modal fade" id="createFolderModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Folder</h5>
                    <button type="button" class="close" id="closeModal" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Folder Name</label>
                            <div class="col-sm-9">
                                <input v-model="createFolderForm.name" type="text" class="form-control">
                                <div class="error" v-if="createFolderForm.errors.name
                                ">
                                    {{ createFolderForm.errors.name }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3"></label>
                            <div class="col-sm-9">
                                <!-- disabled button on form processing -->
                                <button type="submit" @click.prevent="createFolder()"
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


export default {
    props: ['user_id'],
    data() {
        return {
            createFolderForm: useForm({
                name: '',
                user_id: this.user_id
            })
        }

    },

    methods: {

        createFolder() {
            this.createFolderForm.post('/user/folder', {
                preserveScroll: true,
                onSuccess: () => {
                    document.getElementById('closeModal').click()
                    this.$emit('close')
                }
            })
        }

    }
}


</script>