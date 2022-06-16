<template>
<div>
    <ConfirmDialog></ConfirmDialog>

    <div class="pb-5" style="margin-bottom: 20px">
        <h4 class="float-start card-title">Brands</h4>
        <Button label="Create" @click="create" class="float-end p-button-sm" />
    </div>

    <DataTable
        ref="dt"
        dataKey="id"
        responsiveLayout="scroll"
        paginatorTemplate="CurrentPageReport FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink"
        :value="users"
        :lazy="true"
        :paginator="true"
        :rows="perPage"
        :totalRecords="totalRecords"
        :loading="loading"
        @page="onPage($event)"
        @sort="onSort($event)"
    >
        <Column field="name" header="Name" ref="name"></Column>

        <Column field="email" header="Email" ref="email"></Column>

        <Column :bodyStyle="{'text-align': 'center', overflow: 'visible'}">
            <template #body="{data}">
                <Button icon="pi pi-trash" class="float-end p-button-sm p-button-danger" @click="remove(data.id)" />
                <Button icon="pi pi-pencil" class="float-end p-button-sm p-button-secondary p-button-outlined mx-lg-1" @click="edit(data.id)" />
            </template>
        </Column>
    </DataTable>
</div>
</template>

<script>
export default {
    name: "BrandGrid",

    data: () => ({
        users: null,
        loading: false,
        totalRecords: 0,
        perPage: null,
        lazyParams: {},
    }),

    mounted() {
        this.lazyParams = {
            first: 1,
            rows: this.$refs.dt.rows,
            sortField: null,
            sortOrder: null,
            page: 0
        };

        this.fetch();
    },

    methods: {
        async fetch(){
            this.loading = true;

            const queryString = `?page=${this.lazyParams.page + 1 || ''}`;
            const response = await this.$http.get('/api/brands' + queryString)

            this.users = response.data.data;
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

        create(){
            this.$router.push({ name: 'brands.create' });
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
                    await this.$http.delete('/api/brands/' + id)
                    await this.fetch()
                },
                reject: () => {
                    //callback to execute when user rejects the action
                }
            });
        }
    }
}
</script>

