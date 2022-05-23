<template>
    <div>
        <ConfirmDialog></ConfirmDialog>

        <div class="pb-5">
            <Button label="Create" @click="create" class="float-end" />
        </div>

        <DataTable
            ref="dt"
            dataKey="id"
            responsiveLayout="scroll"
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
            <Column field="card_code" header="Card Code" filterMatchMode="startsWith" ref="card_code" :sortable="true">
                <template #filter="{filterModel,filterCallback}">
                    <InputText type="text" v-model="filterModel.value" @keydown.enter="filterCallback()" class="p-column-filter" placeholder="Search by card code"/>
                </template>
            </Column>

            <Column field="description" header="Description" filterField="description" filterMatchMode="contains" ref="description" :sortable="true">
                <template #filter="{filterModel,filterCallback}">
                    <InputText type="text" v-model="filterModel.value" @keydown.enter="filterCallback()" class="p-column-filter" placeholder="Search by description"/>
                </template>
            </Column>

            <Column :bodyStyle="{'text-align': 'center', overflow: 'visible'}">
                <template #body="{data}">
                    <Button type="button" icon="pi pi-pencil" class="p-button-warning" @click="edit(data.id)"></Button>
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
            'cardCode': {value: '', matchMode: 'contains'},
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

            const queryString = `?page=${this.lazyParams.page + 1 || ''}&sort=${this.lazyParams.sortField || '' }&sortOrder=${this.lazyParams.sortOrder || ''}`
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
                accept: () => {
                    this.$http.delete('/api/products/' + id)
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
