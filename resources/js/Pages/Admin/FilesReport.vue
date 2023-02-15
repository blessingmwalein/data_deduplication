<template>
    <MainLayout :viewStorage="viewStorage" :viewDetails="viewDetails" :selectedFile="selectedFile"
        @closeFile="closeFile" :images='images' :files='files' :videos='videos' :audios='audios'>


        <div class="content">
            <div class="page-header d-flex justify-content-between">
                <h2>Duplicate Files</h2>
                <a href="#" class="files-toggler">
                    <i class="ti-menu"></i>
                </a>
            </div>

            <div class="row">
                <div class="col-xl-3 files-sidebar">
                    <div class="card border-0">
                        <h6 class="card-title">Files</h6>
                        <ul id="myUL">
                            <li style="cursor:pointer" v-for="file in filesToLoop" @click="selectedFile = file[1]"><span
                                    class="caret"><span><i
                                            class="jstree-icon jstree-themeicon ti-file text-warning jstree-themeicon-custom mr-2"></i></span>{{
                                                file[1][0]?.data.name
                                            }}</span>

                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-9" v-if="selectedFile">
                    <div class="content-title mt-0">
                        <h4>Total Duplicate Files :{{selectedFile.length}}</h4>
                        <h6>Total Memory Saved:{{calcTotalMemorySaved()}} </h6>
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
                                <tr v-for="file in selectedFile">

                                    <td>
                                        <a href="#" class="d-flex align-items-center">
                                            <figure class="avatar avatar-sm mr-3">
                                                <span class="avatar-title bg-warning text-black-50 rounded-pill">
                                                    <i class="ti-folder"></i>
                                                </span>
                                            </figure>
                                            <span class="d-flex flex-column">
                                                <span class="text-primary">{{ file.data.name }}</span>
                                                <span class="small font-italic">{{ file.data.fileSize }}</span>
                                            </span>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" class="d-flex align-items-center">
                                            <figure class="avatar  avatar-sm mr-3" title="" data-toggle="tooltip"
                                                data-original-title="Cullie Philcott">
                                                <span class="avatar-title bg-warning rounded-pill">{{
                                                    getInitials(file.data.user.name)
                                                }}</span>
                                            </figure>
                                            <span class="d-flex flex-column">
                                                <span class="text-primary">{{ file.data.user.name }}</span>
                                            </span>
                                        </a>
                                    </td>
                                    <td>{{ file.data.created_at }}</td>
                                    <td>
                                        <div class="badge bg-info-bright text-info">{{ file.data.fileType }}</div>
                                    </td>

                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-floating" data-toggle="dropdown">
                                                <i class="ti-more-alt"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item"
                                                    @click.prevent="selectFile(file.data)">View
                                                    Details</a>

                                                <a href="#" class="dropdown-item"
                                                    @click.prevent="downloadFile(file.data.path)">Download</a>

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

        </div>
    </MainLayout>

</template>

<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link } from '@inertiajs/vue3';
export default {
    props: ['folders', 'images', 'files', 'videos', 'audios', 'duplicateFiles', 'similarFiles'],
    data() {
        return {
            viewStorage: true,
            viewDetails: false,
            selectedFile: null,
            filesToLoop: [],
            baseUrl: 'http://127.0.0.1:8000/storage/',
        }
    },
    components: {
        MainLayout,
        Link
    },
    methods: {
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

        //get user initials
        getInitials(name) {
            var names = name.split(' '),
                initials = names[0].substring(0, 1).toUpperCase();

            if (names.length > 1) {
                initials += names[names.length - 1].substring(0, 1).toUpperCase();
            }
            return initials;
        },

        //create function to calc total memory saved
        calcTotalMemorySaved() {
            let total = 0
            this.selectedFile.forEach(file => {
                total += parseFloat(file.data.size)
            })

            //check if total is greater than 1mb
            if (total > 1000000) {
                return (total / 1000000).toFixed(2) + ' MB'
            }

            //check if total is greater than 1kb
            if (total > 1000) {
                return (total / 1000).toFixed(2) + ' KB'
            }

            //check if total is greater than 1gb
            if (total > 1000000000) {
                return (total / 1000000000).toFixed(2) + ' GB'
            }

            //check if total is greater than 1tb
            if (total > 1000000000000) {
                return (total / 1000000000000).toFixed(2) + ' TB'
            }

            return total -parseFloat(this.selectedFile[0].data.size) + ' B';
        },
    },
    mounted() {
        this.filesToLoop = Object.entries(this.similarFiles)
        this.selectedFile = this.filesToLoop[0][1]
    }
}
</script>