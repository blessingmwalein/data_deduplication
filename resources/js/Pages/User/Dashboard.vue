<template>
    <MainLayout :viewStorage="viewStorage" :viewDetails="viewDetails" :selectedFile="selectedFile"
        @closeFile="closeFile" :images='images' :files='files' :videos='videos' :audios='audios'>
        <div class="content">



            <div class="content-title d-flex justify-content-between">
                <h4>Recent Folders</h4>
                <Link href="/user/files">View All</Link>
            </div>

            <div class="row">
                <div class="col-md-3" v-for="folder in folders.data">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-4">
                                <div>
                                    <i class="font-size-22 ti-folder"></i>
                                </div>
                                <div>

                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5>{{ folder.name }}</h5>
                               
                            </div>
                            <p class="small text-muted mb-0">{{folder.files.length}} Files</p>
                        </div>
                    </div>
                </div>

            </div>


            <div class="content-title d-flex justify-content-between">
                <h4>Recent Files</h4>
                <Link href="/user/files">View All</Link>
            </div>

            <div class="mb-4">
                <div class="table-responsive">
                    <table id="table-files" class="table table-borderless table-hover">
                        <thead>
                            <tr>
                              
                                
                                <th>Name</th>
                                <th>Created</th>
                                <th>Type</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody v-if="selectedFolder">
                            <tr v-for="file in selectedFolder.files" >
                               
                                <td>
                                    <a  href="#" class="d-flex align-items-center">
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

                                            <a href="#" class="dropdown-item" @click.prevent="downloadFile(file.path)">Download</a>

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
    </MainLayout>

</template>

<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Link } from '@inertiajs/vue3';
export default {
    props: ['folders', 'images', 'files', 'videos', 'audios', 'recentFiles'],
    data() {
        return {
            viewStorage: true,
            viewDetails: false,
            selectedFolder: this.folders.data[0],
            selectedFile: null,
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
    },
    mounted() {
        // ...
    }
}
</script>