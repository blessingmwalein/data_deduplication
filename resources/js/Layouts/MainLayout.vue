<template>
    <div class="layout-wrapper">
        <div class="header d-print-none">
            <div class="header-container">
                <div class="header-body">
                    <div class="header-body-left">
                        <ul class="navbar-nav">
                            <li class="nav-item navigation-toggler">
                                <a href="#" class="nav-link">
                                    <i class="ti-menu"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <div class="header-search-form">
                                    <form>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button class="btn">
                                                    <i class="ti-search"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Search something...">
                                            <div class="input-group-append">
                                                <button class="btn header-search-close-btn">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="header-body-right">
                        <ul class="navbar-nav">

                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link profile-nav-link dropdown-toggle" title="User menu"
                                    data-toggle="dropdown">
                                    <span class="mr-2 d-sm-inline d-none">{{ $page.props?.user.name }}</span>
                                    <figure class="avatar avatar-sm">
                                        <img :src="$page.props?.user.profile_photo_url" class="rounded-circle"
                                            alt="avatar">
                                    </figure>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                                    <div class="text-center py-4"
                                        data-background-image="/assets/media/image/image1.jpg">
                                        <figure class="avatar avatar-lg mb-3 border-0">
                                            <img :src="$page.props?.user.profile_photo_url" class="rounded-circle"
                                                alt="image">
                                        </figure>
                                        <h5 class="mb-0">{{ $page.props?.user.name }}</h5>
                                    </div>
                                    <div class="list-group list-group-flush">
                                        <a href="#" @click="logout" class="list-group-item text-danger"
                                            data-sidebar-target="#settings">Sign Out!</a>
                                    </div>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item header-toggler">
                        <a href="#" class="nav-link">
                            <i class="ti-arrow-down"></i>
                        </a>
                    </li>
                    <li class="nav-item sidebar-toggler">
                        <a href="#" class="nav-link">
                            <i class="ti-cloud"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="content-wrapper">
            <div class="navigation">
                <div class="logo mt-2" style="margin-left:30px">
                    <Link href="/">
                    <img src="/assets/media/image/logo.png" alt="logo">
                    </Link>
                </div>
                <ul v-if="$page.props?.user.role == 'admin'">
                    <li>
                        <Link href="/">
                        <i class="nav-link-icon ti-pie-chart"></i>
                        <span class="nav-link-label">Dashboard</span>
                        <span class="badge badge-danger badge-small">2</span>
                        </Link>
                    </li>
                    <li>
                        <a href="/admin/files">
                            <i class="nav-link-icon ti-file"></i>
                            <span class="nav-link-label">Files Manager</span>
                        </a>
                    </li>
                    <li>
                        <Link href="/admin/reports">
                        <i class="nav-link-icon ti-pulse"></i>
                        <span class="nav-link-label">Files Report</span>
                        <span class="badge badge-warning">New</span>
                        </Link>
                    </li>
                    <li>
                        <Link href="/admin/users">
                        <i class="nav-link-icon ti-user"></i>
                        <span class="nav-link-label">Users</span>
                        </LInk>
                    </li>


                </ul>
                <ul v-if="$page.props?.user.role == 'user'">
                    <li>
                        <Link href="/user/dashboard">
                        <i class="nav-link-icon ti-pie-chart"></i>
                        <span class="nav-link-label">Dashboard</span>
                        <span class="badge badge-danger badge-small">2</span>
                        </Link>
                    </li>

                    <li>
                        <Link href="/user/files">
                        <i class="nav-link-icon ti-file"></i>
                        <span class="nav-link-label">Files</span>
                        <span class="badge badge-warning">New</span>
                        </Link>
                    </li>

                </ul>
            </div>

            <div class="content-body">
                <slot />
                <footer class="content-footer d-print-none">
                    <div>© 2022 Upload Files - <a href="#" target="_blank">Creater</a></div>

                </footer>
            </div>
            <div class="sidebar-group d-print-none">
                <!-- Sidebar - Storage -->
                <div class="sidebar primary-sidebar" :class="[viewStorage ? 'show' : '']" id="storage">
                    <div class="sidebar-header">
                        <h4>Storage Overview</h4>
                    </div>
                    <div class="sidebar-content">
                        <div id="justgage_five" class="mb-3"></div>
                        <div>
                            <div class="list-group list-group-flush mb-3">
                                <a href="#" class="list-group-item px-0 d-flex align-items-center">
                                    <div class="mr-3">
                                        <figure class="avatar">
                                            <span class="avatar-title bg-primary-bright text-primary rounded">
                                                <i class="ti-image"></i>
                                            </span>
                                        </figure>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="mb-0">Images</p>
                                        <span class="small text-muted">{{ images?.data?.length }} Files</span>
                                    </div>
                                    <div>
                                        <h5 class="text-primary">{{ calcTotalStorage(images?.data) }}</h5>
                                    </div>
                                </a>
                                <a href="#" class="list-group-item px-0 d-flex align-items-center">
                                    <div class="mr-3">
                                        <figure class="avatar">
                                            <span class="avatar-title bg-primary-bright text-primary rounded">
                                                <i class="ti-control-play"></i>
                                            </span>
                                        </figure>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="mb-0">Videos</p>
                                        <span class="small text-muted">{{ videos?.data?.length }} Files</span>
                                    </div>
                                    <div>
                                        <h5 class="text-primary">{{ calcTotalStorage(videos?.data) }}</h5>
                                    </div>
                                </a>
                                <a href="#" class="list-group-item px-0 d-flex align-items-center">
                                    <div class="mr-3">
                                        <figure class="avatar">
                                            <span class="avatar-title bg-primary-bright text-primary rounded">
                                                <i class="ti-files"></i>
                                            </span>
                                        </figure>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="mb-0">Documents</p>
                                        <span class="small text-muted">{{ files?.data.length }} Files</span>
                                    </div>
                                    <div>
                                        <h5 class="text-primary">{{ calcTotalStorage(files?.data) }}</h5>
                                    </div>
                                </a>
                                <a href="#" class="list-group-item px-0 d-flex align-items-center">
                                    <div class="mr-3">
                                        <figure class="avatar">
                                            <span class="avatar-title bg-primary-bright text-primary rounded">
                                                <i class="ti-file"></i>
                                            </span>
                                        </figure>
                                    </div>
                                    <div class="flex-grow-1">
                                        <p class="mb-0">Audios Files</p>
                                        <span class="small text-muted">{{ audios?.data.length }} Files</span>
                                    </div>
                                    <div>
                                        <h5 class="text-primary">{{ calcTotalStorage(audios?.data) }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="sidebar-footer">
                        <button class="btn btn-lg btn-block btn-outline-primary">
                            <i class="fa fa-cloud-upload mr-3"></i> Upload
                        </button>
                    </div>
                </div>
                <!-- ./ Sidebar - Storage -->

                <!-- Sidebar - File info -->
                <div class="sidebar" :class="[viewDetails ? 'show' : '']" id="view-detail" v-if="viewDetails">
                    <div class="sidebar-header">
                        <h4>View Detail</h4>
                        <a href="#" class="btn btn-light btn-floating sidebar-close-btn" @click="closeFile">
                            <i class="ti-angle-right"></i>
                        </a>
                    </div>
                    <div class="sidebar-content">
                        <figure class="avatar mb-4">
                            <span class="avatar-title bg-info-bright text-info rounded-pill">
                                <i class="ti-file"></i>
                            </span>
                        </figure>
                        <div class="row mb-3">
                            <div class="col-md-5">File name:</div>
                            <div class="col-md-7"><a href="#" class="link-1">{{ selectedFile.name }}</a></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-5">File type:</div>
                            <div class="col-md-7">{{ selectedFile.fileName }}-{{ selectedFile.fileType }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-5">File size:</div>
                            <div class="col-md-7">{{ selectedFile.fileSize }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-5">Created:</div>
                            <div class="col-md-7">{{ selectedFile.created_at }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-5">Modified:</div>
                            <div class="col-md-7 text-success">{{ selectedFile.updated_at }}</div>
                        </div>

                    </div>
                    <div class="sidebar-footer">
                        <button @click="downloadFile(selectedFile.path)" class="btn btn-lg btn-block btn-primary">
                            <i class="ti-share mr-3"></i> Download
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <vue3-snackbar bottom right :duration="4000"></vue3-snackbar>

    </div>
</template>
<script>
import { Link } from '@inertiajs/vue3';
import globalMixin from "@/Mixins/global.js";

export default {
    props: ['viewStorage', 'viewDetails', "selectedFile", 'images', 'files', 'videos', 'audios'],
    name: "App",
    data() {
        return {
            user: null,
            details: this.viewDetails,
            storage: this.viewStorage,
            baseUrl: 'http://127.0.0.1:8000/storage/',
        };
    },
    mixins: [globalMixin],
    methods: {
        logout() {
            this.$inertia.post('/logout');
        },
        closeFile() {
            this.$emit('closeFile');
        },
        downloadFile(url) {
            window.open(`${this.baseUrl}${url}`)
        },

        //create function to calc total storage for images to gb
        calcTotalStorage(files) {
            let total = 0;
            files.forEach((file) => {
                total += parseFloat(file.size);
            });

            //check if total is greater than 1 mb
            if (total > 1000) {
                return (total / 1000).toFixed(2) + " MB";
            }

            //check if total is greater than 1 gb
            if (total > 1000000) {
                return (total / 1000000).toFixed(2) + "";
            }

            //check if total is greater than 1 tb
            if (total > 1000000000) {
                return (total / 1000000000).toFixed(2) + " TB";
            }

            return total + " KB";
        },

    },
    mounted() {
        this.user = this.$page.props.user;

    },
    components: { Link },

    watch: {
        //watch to flash messages
        $page(newProps, oldProps) {
            if (newProps.props.flash.success) {
                this.fireSnackbar(newProps.props.flash.success, "Success", "#31CF80", "info");
            }
            if (newProps.props.flash.error) {
                this.fireSnackbar(newProps.props.flash.error, "Error", "#D82C5B", "info");
            }
            if (newProps.props.flash.message) {
                this.fireSnackbar(newProps.props.flash.message, "Message", "#2DADCF", "info");
            }
        },
    },
}
</script>