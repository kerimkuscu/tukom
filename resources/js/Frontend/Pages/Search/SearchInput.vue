<template>
    <div v-if="!$auth.check()" class="me-auto mb-2" style="width: 450px">
        <div class="dropdown align-items-center">
            <div class="input-group">
                <input
                    ref="searchInput"
                    v-model="model"
                    type="text"
                    class="form-control"
                    autocomplete="off"
                    autofocus
                    @keyup="getSugessions"
                    @focus.prevent="showDropdowns = model.length > 0"

                >
                <button class="p-button-sm p-button-secondary p-button-outlined p-button p-component"
                        type="button"
                        @click="search">
                    <span class="p-button-label">
                        <i class="pi pi-search pt-1"></i>
                    </span>
                </button>

            </div>
            <div class="dropdown-menu w-100 p-1"
                 :class="{'show': showDropdowns}"
                 aria-labelledby="dropdownCardMenu">
                <div v-for="(suggestion, index) in suggestions"
                     class="dropdown-item px-2 py-0" @click="productDetail(suggestion)" style="cursor: pointer">
                    {{ suggestion.description }}
                </div>
                <div v-if="!suggestions.length" class="dropdown-item px-2 py-0">
                    No product found
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "SearchInput",

    data() {
        return {
            model: '',
            showDropdowns: false,
            suggestions: []
        }
    },

    mounted() {
        document.addEventListener('click', this.close)
    },
    beforeDestroy() {
        document.removeEventListener('click', this.close)
    },

    methods: {
        async getSugessions() {
            const response = await this.$http.get(`/api/products?search=1&description= ${this.model}`);

            this.suggestions = response.data.data;

            this.showDropdowns = this.model.length > 0;

            this.focusToInput();
        },

        focusToInput() {
            this.$nextTick(() => this.$refs.searchInput.focus());
        },

        productDetail(item) {
            this.$eventHub.$emit('products-details', item);
            let urlProductName = item.menu;
            urlProductName = urlProductName.replace(/\s+/g, '-').toLowerCase();
            this.$router.push({name: 'products.details', params: {productName: urlProductName, productId: item.id}});

            this.showDropdowns = false;
        },

        close(e) {
            if (!this.$el.contains(e.target)) {
                this.showDropdowns = false
            }
        },

        search() {
            this.$eventHub.$emit('search',this.model);
        }
    }
}
</script>

<style scoped>
.dropdown-menu {
    max-height: 500px;
    overflow-y: scroll;
}
</style>
