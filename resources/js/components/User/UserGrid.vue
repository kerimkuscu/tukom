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
        :value="users"
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
        <Column field="name" header="Name" filterMatchMode="startsWith" ref="name" :sortable="true">
            <template #filter="{filterModel,filterCallback}">
                <InputText type="text" v-model="filterModel.value" @keydown.enter="filterCallback()" class="p-column-filter" placeholder="Search by name"/>
            </template>
        </Column>

        <Column field="email" header="Email" filterField="email" filterMatchMode="contains" ref="email" :sortable="true">
            <template #filter="{filterModel,filterCallback}">
                <InputText type="text" v-model="filterModel.value" @keydown.enter="filterCallback()" class="p-column-filter" placeholder="Search by email"/>
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
    name: "UserGrid",

    data: () => ({
        users: null,
        loading: false,
        totalRecords: 0,
        perPage: null,
        lazyParams: {},

        filters: {
            'name': {value: '', matchMode: 'contains'},
            'email': {value: '', matchMode: 'contains'},
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

            const queryString = `?page=${this.lazyParams.page + 1 || ''}&sort=${this.lazyParams.sortField || '' }&sortOrder=${this.lazyParams.sortOrder || ''}&name=${this.lazyParams.filters.name.value || ''}&email=${this.lazyParams.filters.email.value || ''}`
            const response = await this.$http.get('/api/users' + queryString)

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

        onFilter(event){
            this.lazyParams = event;
            this.fetch();
        },

        create(){
            this.$router.push({ name: 'users.create' });
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
                    this.$http.delete('/api/users/' + id)
                },
                reject: () => {
                    //callback to execute when user rejects the action
                }
            });
        }
    }
}
</script>

