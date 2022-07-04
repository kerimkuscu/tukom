<template>
    <div class="container-fluid">
        <div class="row justify-content-center m-2">
            <div class="card">
                <div class="card-body">
                    <div class="ql-editor" v-html="aboutText" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'About',

    data:() => ({
        aboutText: null,
    }),

    mounted() {
        this.getAboutText();
    },

    methods: {
        async getAboutText() {
            const response = await this.$http.get('/api/about');
            this.aboutText = response.data.data;
        }
    }
}
</script>
