<template>
    <MainLayout :viewStorage="viewStorage" :viewDetails="viewDetails" :selectedFile="selectedFile"
        @closeFile="closeFile" :images='images' :files='files' :videos='videos' :audios='audios'>
        <div class="content">

            <div class="row">
                <div class="col-md-12">
                    <div class="page-header d-flex justify-content-between">
                        <h2>Users</h2>
                        <ul class="nav">

                            <li class="nav-item">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#createUserModal">Create</button>
                            </li>

                        </ul>
                    </div>

                    <div class="card border-0">
                        <div class="table-responsive">
                            <table id="user-list" class="table table-borderless table-hover">
                                <thead>
                                    <tr>

                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user in users">

                                        <td>
                                            <a href="#">
                                                <figure class="avatar  avatar-sm mr-3" title="" data-toggle="tooltip"
                                                    data-original-title="Cullie Philcott">
                                                    <span
                                                        class="avatar-title bg-warning rounded-pill">{{ getInitials(user.name) }}</span>
                                                </figure>
                                                {{ user.name }}
                                            </a>
                                        </td>
                                        <td>{{ user.email }}</td>

                                        <td>{{ user.role }}</td>
                                        <td>
                                            <span class="badge bg-danger-bright text-danger">{{ user.status }}</span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                                    <i class="ti-more-alt"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">

                                                    <a href="#" class="dropdown-item" @click="editUser(user)"
                                                        data-toggle="modal" data-target="#createUserModal">Edit</a>
                                                    <a href="#" class="dropdown-item"
                                                        @click="submitDelete(user)">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <CreateUser :isEdit="isEdit" :user="selectedUser" />
    </MainLayout>

</template>

<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link } from '@inertiajs/vue3';
// import Tree from 'vuejs-tree'


import CreateUser from '@/Components/Modals/CreateUser.vue';


export default {
    props: ['folders', 'images', 'files', 'videos', 'audios', 'users'],
    data() {
        return {
            treeDisplayData: [

            ],
            isEdit: false,
            viewStorage: true,
            viewDetails: false,
            selectedFolder: this.folders.data[0],
            selectedFile: null,
            selectedUser: null,
            baseUrl: 'http://127.0.0.1:8000/storage/',
        }
    },
    computed: {

    },
    components: {
        MainLayout,
        Link,
        CreateUser
    },
    methods: {
        editUser(user) {
            this.selectedUser = user
            this.isEdit = true
        },
        itemClick(e) {
            console.log('clicked' + e)

        },
        selectFile(file) {
            this.selectedFile = file
            this.viewDetails = true
            this.viewStorage = false
        },
        closeFile() {
            this.viewDetails = false
            this.viewStorage = true
            selectedFile = null
        },
        getInitials(name) {
            var names = name.split(' '),
                initials = names[0].substring(0, 1).toUpperCase();

            if (names.length > 1) {
                initials += names[names.length - 1].substring(0, 1).toUpperCase();
            }
            return initials;
        },
        //create function to sort the folders in accending order

        sortFolders() {
            this.folders.data.sort((a, b) => {
                return a.name.localeCompare(b.name)
            })
        },

        //create function to download the file
        downloadFile(url) {
            window.open(`${this.baseUrl}${url}`)
        },

        submitDelete(user) {
            this.$inertia.delete(`/users/${user.id}`)
        },

    },
    mounted() {
        //map the folders to the tree
        this.folders.data.forEach(folder => {
            this.treeDisplayData.push({
                text: folder.name,
                files:
                    folder.files.map(file => {
                        return {
                            text: file.name,
                        }
                    })
            })
        });

        var toggler = document.getElementsByClassName("caret");
        var i;

        for (i = 0; i < toggler.length; i++) {
            toggler[i].addEventListener("click", function () {
                this.parentElement.querySelector(".nested").classList.toggle("active");
                this.classList.toggle("caret-down");
            });
        }


    }
}
</script>
<style>
ul,
#myUL {
    list-style-type: none;
}

#myUL {
    margin: 0;
    padding: 0;
}

.caret {
    cursor: pointer;
    -webkit-user-select: none;
    /* Safari 3.1+ */
    -moz-user-select: none;
    /* Firefox 2+ */
    -ms-user-select: none;
    /* IE 10+ */
    user-select: none;
}

.caret::before {
    content: "\25B6";
    color: black;
    display: inline-block;
    margin-right: 6px;
}

.caret-down::before {
    -ms-transform: rotate(90deg);
    -webkit-transform: rotate(90deg);
    transform: rotate(90deg);
}

.nested {
    display: none;
    margin-left: 25px !important;
    margin-top: 5px !important;
}

.caret:hover,
.nest-item:hover {
    background-color: orange;
    border-radius: 5px;
    padding: 3px !important;
    color: white;
    cursor: pointer;
}

.active {
    display: block;
}
</style> 