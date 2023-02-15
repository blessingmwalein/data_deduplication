<template>
    <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New User</h5>
                    <button type="button" class="close" id="closeUserModal" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Full Name</label>
                            <div class="col-sm-9">
                                <input v-model="createUserForm.name" type="text" class="form-control">
                                <div class="error" v-if="createUserForm.errors.name
                                ">
                                    {{ createUserForm.errors.name }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input v-model="createUserForm.email" type="email" class="form-control">
                                <div class="error" v-if="createUserForm.errors.email
                                ">
                                    {{ createUserForm.errors.email }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Role</label>
                            <div class="col-sm-9">
                                <select v-model="createUserForm.role" class="form-control">
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                                <div class="error" v-if="createUserForm.errors.role
                                ">
                                    {{ createUserForm.errors.role }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select v-model="createUserForm.status" class="form-control">
                                    <option value="blocked">Blocked</option>
                                    <option value="active">Active</option>
                                </select>
                                <div class="error" v-if="createUserForm.errors.status
                                ">
                                    {{ createUserForm.errors.status }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input v-model="createUserForm.password" type="password" class="form-control">
                                <div class="error" v-if="createUserForm.errors.password
                                ">
                                    {{ createUserForm.errors.password }}
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-3"></label>
                            <div class="col-sm-9">
                                <!-- disabled button on form processing -->
                                <button type="submit" @click.prevent="createUserSubmit()"
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
    props: ['user', 'isEdit'],
    data() {
        return {
            createUserForm: useForm({
                name: this.user?.name,
                email: this.user?.id,
                password: '',
                role: this.user?.role,
                status: this.user?.status,
            })
        }
    },
    mixins: [globalMixin],
    methods: {

        createUserSubmit() {

            if (this.isEdit) {
                this.createUserForm.post('/users/' + this.user.id, {
                    preserveScroll: true,
                    onSuccess: () => {
                        document.getElementById('closeUserModal').click()
                        this.$emit('close')
                    }
                })
            } else {
                this.createUserForm.post('/users', {
                    preserveScroll: true,
                    onSuccess: () => {
                        document.getElementById('closeUserModal').click()
                        this.$emit('close')
                    }
                })
            }

        },
    },

    //watch user prop for changes
    watch: {
        user: {
            handler: function (newVal, oldVal) {
                this.createUserForm.name = newVal.name
                this.createUserForm.email = newVal.email
                this.createUserForm.role = newVal.role
                this.createUserForm.status = newVal.status
            },
            deep: true
        }
    }

}


</script>