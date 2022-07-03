export default {
    data: () => ({
        originPathName: null
    }),

    mounted() {
        this.getPathName();
    },

    methods: {
        getPathName() {
            this.originPathName = window.location.origin + '/images/';
        }
    }
}
