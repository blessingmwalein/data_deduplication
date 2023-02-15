<template>
    <MainLayout :viewStorage="viewStorage" :viewDetails="viewDetails" :selectedFile="selectedFile"
        @closeFile="closeFile" :images='images' :files='files' :videos='videos' :audios='audios'>
        <div class="content">
            <div class="page-header d-flex justify-content-between">
                <h2>Files</h2>
                <a href="#" class="files-toggler">
                    <i class="ti-menu"></i>
                </a>
            </div>

            <div class="row">
                <div class="col-xl-3 files-sidebar">
                    <div class="card border-0">
                        <h6 class="card-title">My Folders</h6>
                        <ul id="myUL">
                            <li v-for="folder in folders.data" @click="selectedFolder = folder"><span
                                    class="caret"><span><i
                                            class="jstree-icon jstree-themeicon ti-folder text-warning jstree-themeicon-custom mr-2"
                                            role="presentation"></i></span>{{ folder.name }}</span>
                                <ul class="nested">
                                    <li class="nest-item" @click="selectFile(file)" v-for="file in folder.files">
                                        <span><i
                                                class="jstree-icon jstree-themeicon ti-file text-warning jstree-themeicon-custom mr-2"></i></span>{{
                                                    file.name
                                                }}
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="content-title mt-0">
                        <h4>{{ selectedFolder.name }}</h4>
                        <h6>{{ selectedFolder.path }}</h6>

                    </div>
                    <div class="d-md-flex justify-content-between mb-4">
                        <ul class="list-inline mb-3">
                            <li class="list-inline-item mb-0">
                                <a href="#" class="btn btn-outline-light dropdown-toggle" data-toggle="dropdown">
                                    Add
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" data-toggle="modal" data-target="#createFolderModal"
                                        href="#">New Folder</a>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#createFileModal"
                                        href="#">New File</a>
                                </div>
                            </li>


                        </ul>
                        <div id="file-actions" class="d-none">
                            <ul class="list-inline">
                                <li class="list-inline-item mb-0">
                                    <a href="#" class="btn btn-outline-light" data-toggle="tooltip" title="Move">
                                        <i class="ti-arrow-top-right"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item mb-0">
                                    <a href="#" class="btn btn-outline-light" data-toggle="tooltip"
                                        @click="downloadFile(file.path)" title="Download">
                                        <i class="ti-download"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item mb-0">
                                    <a href="#" class="btn btn-outline-danger" data-toggle="tooltip" title="Delete">
                                        <i class="ti-trash"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="table-files" class="table table-borderless table-hover">
                            <thead>
                                <tr>
                                
                                    <th>Name</th>
                                    <th>User</th>
                                    <th>Created</th>
                                    <th>Type</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="file in selectedFolder.files">
                                  
                                    <td>
                                        <a href="#" class="d-flex align-items-center">
                                            <figure class="avatar avatar-sm mr-3">
                                                <span class="avatar-title bg-warning text-black-50 rounded-pill">
                                                    <i class="ti-folder"></i>
                                                </span>
                                            </figure>
                                            <span class="d-flex flex-column">
                                                <span class="text-primary">{{ file.name }}</span>
                                                <span class="small font-italic">{{ file.fileSize }}</span>
                                            </span>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" class="d-flex align-items-center">
                                            <figure class="avatar  avatar-sm mr-3" title="" data-toggle="tooltip"
                                                data-original-title="Cullie Philcott">
                                                <span
                                                    class="avatar-title bg-warning rounded-pill">{{ getInitials(file.user.name) }}</span>
                                            </figure>
                                            <span class="d-flex flex-column">
                                                <span class="text-primary">{{ file.user.name }}</span>
                                            </span>
                                        </a>
                                    </td>
                                    <td>{{ file.created_at }}</td>
                                    <td>
                                        <div class="badge bg-info-bright text-info">{{ file.fileType }}</div>
                                    </td>

                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                                <i class="ti-more-alt"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item" @click.prevent="selectFile(file)">View
                                                    Details</a>

                                                <a href="#" class="dropdown-item"
                                                    @click.prevent="downloadFile(file.path)">Download</a>

                                                <a href="#" class="dropdown-item">Edit</a>
                                                <a href="#" class="dropdown-item">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <CreateFolder :user_id="$page?.props?.user.id" />
            <CreateFile :user_id="$page?.props?.user.id" :folders="folders.data" :folder_id="selectedFolder.id" />


        </div>
    </MainLayout>

</template>

<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link } from '@inertiajs/vue3';
// import Tree from 'vuejs-tree'


import CreateFolder from '@/Components/Modals/CreateFolder.vue';
import CreateFile from '../../Components/Modals/CreateFile.vue';


export default {
    props: ['folders', 'images', 'files', 'videos', 'audios'],
    data() {
        return {
            treeDisplayData: [

            ],
            viewStorage: true,
            viewDetails: false,
            selectedFolder: this.folders.data[0],
            selectedFile: null,
            baseUrl: 'http://127.0.0.1:8000/storage/',
        }
    },
    computed: {

    },
    components: {
        MainLayout,
        Link,
        CreateFolder,
        CreateFile,
    },
    methods: {
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