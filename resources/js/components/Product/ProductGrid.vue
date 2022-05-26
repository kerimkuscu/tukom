<template>
    <div>
        <ConfirmDialog></ConfirmDialog>

        <div class="pb-5" style="margin-bottom: 20px">
            <Button label="Create" @click="create" class="float-end" />
        </div>

        <DataTable
            ref="dt"
            dataKey="id"
            responsiveLayout="scroll"
            :scrollable="true"
            scrollHeight="1500px"
            scrollDirection="both"
            :value="products"
            :lazy="true"
            :paginator="true"
            :rows="perPage"
            :totalRecords="totalRecords"
            :loading="loading"
            filterDisplay="row"
            :filters.sync="filters"
            :globalFilterFields="['name','email']"
            @page="onPage($event)"
            @sort="onSort($event)"
            @filter="onFilter($event)"
        >
            <Column field="card_code" header="Card Code" filterMatchMode="startsWith" ref="card_code" :sortable="true" :styles="{'min-width':'400px'}">
                <template #filter="{filterModel,filterCallback}">
                    <InputText type="text" v-model="filterModel.value" @keydown.enter="filterCallback()" class="p-column-filter" placeholder="Search by card code"/>
                </template>
            </Column>

            <Column field="description" header="Description" filterField="description" filterMatchMode="contains" ref="description" :sortable="true" :styles="{'min-width':'400px'}">
                <template #filter="{filterModel,filterCallback}">
                    <InputText type="text" v-model="filterModel.value" @keydown.enter="filterCallback()" class="p-column-filter" placeholder="Search by description"/>
                </template>
            </Column>

            <Column field="type" header="Type" :styles="{'min-width':'150px'}"></Column>
            <Column field="brand" header="Brand" :styles="{'min-width':'150px'}"></Column>
            <Column field="fiili_stok" header="Fiili Stok" :styles="{'min-width':'150px'}"></Column>
            <Column field="actual_stock" header="Actual stock" :styles="{'min-width':'150px'}"></Column>
            <Column field="main_unit" header="Main Unit" :styles="{'min-width':'150px'}"></Column>
            <Column field="price" header="Price" :styles="{'min-width':'150px'}"></Column>
            <Column field="currency" header="Currency" :styles="{'min-width':'150px'}"></Column>
            <Column field="group_code" header="Group Code" :styles="{'min-width':'150px'}"></Column>
            <Column field="special_code_1" header="Special Code 1" :styles="{'min-width':'150px'}"></Column>

            <Column :exportable="false" :styles="{'min-width':'8rem'}">
                <template #body="{data}">
                    <Button type="button" icon="pi pi-pencil" style="margin-right: 10px" class="p-button-warning" @click="edit(data.id)"></Button>
                    <Button type="button" icon="pi pi-trash" class="p-button-danger" @click="remove(data.id)"></Button>
                </template>
            </Column>

        </DataTable>

    </div>
</template>

<script>
export default {
    name: "ProductGrid",

    data: () => ({
        products: null,
        loading: false,
        totalRecords: 0,
        perPage: null,
        lazyParams: {},

        filters: {
            'card_code': {value: '', matchMode: 'contains'},
            'description': {value: '', matchMode: 'contains'},
        },
    }),

    mounted() {
        this.lazyParams = {
            first: 1,
            rows: this.$refs.dt.rows,
            sortField: null,
            sortOrder: null,
            filters: this.filters,
            page: 0
        };

        this.fetch();
    },

    methods: {
        async fetch(){
            this.loading = true;

            const queryString = `?page=${this.lazyParams.page + 1 || ''}&sort=${this.lazyParams.sortField || '' }&sortOrder=${this.lazyParams.sortOrder || ''}&card_code=${this.lazyParams.filters.card_code.value || ''}&description=${this.lazyParams.filters.description.value || ''}`

            const response = await this.$http.get('/api/products' + queryString)

            this.products = response.data.data;
            this.totalRecords = response.data.meta.total
            this.perPage = response.data.meta.per_page

            this.loading = false;

        },

        onPage(event) {
            this.lazyParams = event;
            this.fetch();
        },

        onSort(event){
            this.lazyParams = event;
            this.fetch();
        },

        onFilter(event){
            this.lazyParams = event;
            this.fetch();
        },

        create(){
            this.$router.push({ name: 'products.create' });
        },

        edit(id){
            this.$router.push({ path: 'edit/' + id });
        },

        remove(id){
            this.$confirm.require({
                message: 'Are you sure you want to delete this record?',
                header: 'Confirmation',
                icon: 'pi pi-exclamation-triangle',
                accept: async () => {
                    await this.$http.delete('/api/products/' + id)
                    await this.fetch();
                },
                reject: () => {
                    //callback to execute when user rejects the action
                }
            });
        }
    }
}
</script>

<style scoped>

</style>
