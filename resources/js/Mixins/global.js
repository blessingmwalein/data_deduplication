export default {
    data() {
        return {
            requestStatusOptions: [
                { value: 'All', text: 'All' },
                { value: 'Request Sent', text: 'Request Sent' },
                { value: 'Offer Ready', text: 'Offer Ready' },
                { value: 'Signed Off', text: 'Signed Off' },
                { value: 'In-Progress', text: 'In-Progress' },
                { value: 'Contractor Sent', text: 'Contractor Sent' },
                { value: 'Completed', text: 'Completed' },
            ],
            projectOptions: [
                { value: 'In-Progress', text: 'In-Progress' },
                { value: 'Completed', text: 'Completed' },
                { value: 'Canceled', text: 'Canceled' },
                { value: 'Paused', text: 'Paused' },
            ]
        }
    },
    created: function () { },
    methods: {
        getInitials(firstname, lastname) {
            return firstname.charAt(0) + lastname.charAt(0);
        },
        generateFakeId() {
            return Math.floor(Math.random() * 1000000);
        },
        generateCreatedAt() {
            //format date to YYYY-MM-DD HH:MM:SS
            return new Date().toISOString().slice(0, 19).replace("T", " ");
        },
        //fire snackbar
        fireSnackbar(message, title, color, type = "infor") {
            this.$snackbar.add({
                type: type,
                info: type,
                background: color,
                text: message,
                title: title,
            });
        },

        //format string date to YYYY-MM-DD HH:MM:SS

        formatDateToYMD(date) {
            var date = new Date(date);
            return date.toISOString().slice(0, 19).replace("T", " ");
        },

        //format get date to YYYY-MM-DD
        formatDateToYMDOnly(date) {
            var date = new Date(date);
            return date.toISOString().slice(0, 10);
        },
        // formatDate(date){
        //     var date = new Date(date);
        //     return date.toISOString().slice(0, 19).replace("T", " ");
        // }
        //remove slash from string
        removeSlash(str) {
            return str.replace(/\\/g, "");
        },

        //create function to check if a url name if image or file
        isImage(url) {
            const imageWithSlash =this.removeSlash(url);
            console.log('withoutholder' +imageWithSlash);
            return this.removeSlash(url).match(/\.(jpeg|jpg|gif|png)$/) != null;
        },

        //check if file is audio

        isAudio(url) {
            return url.match(/\.(mp3|wav|webm|ogg)$/) != null;
        },
        isFileImage(file) {
            return file && file['type'].split('/')[0] === 'image';
        },
        //check if file is file
        isFileType(file) {
            return file && file['type'].split('/')[0] === 'application';
        },


        //check if file is video
        isVideo(url) {
            return url.match(/\.(mp4|webm|ogg)$/) != null;
        },


        isFile(url) {
            return this.removeSlash(url).match(/\.(pdf|doc|docx|xls|xlsx|ppt|pptx)$/) != null;
        },

        getFileName(url) {
            let splitUrl = url.split('/');
            return this.removeExtension(splitUrl[splitUrl.length - 1]);
        },

        //remove extension from file name
        removeExtension(fileName) {
            return fileName.split('.').slice(0, -1).join('.');
        },

        isAdmin() {
            return $page.props?.user.roles[0]?.role.name == 'admin';
        }
    },
};
