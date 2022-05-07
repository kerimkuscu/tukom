<template>
<div>
    <div class="pb-5">
        <Button label="Create" @click="create" class="float-end" />
    </div>

    <DataTable :value="users" :lazy="true" :paginator="true" :rows="perPage" ref="dt" dataKey="id"
               :totalRecords="totalRecords" :loading="loading"
               responsiveLayout="scroll"
               >
        <Column field="name" header="Name" filterMatchMode="startsWith" ref="name" :sortable="true"></Column>
        <Column field="email" header="Email" filterField="email" filterMatchMode="contains" ref="email" :sortable="true"></Column>

        <Column :bodyStyle="{'text-align': 'center', overflow: 'visible'}">
            <template #body="{data}">
                <Button type="button" icon="pi pi-pencil" class="p-button-warning" @click="edit(data.id)"></Button>
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
        perPage: null
    }),

    mounted() {
        this.fetch();
    },

    methods: {
        async fetch(){
            const response = await this.$http.get('/api/users')
            this.users = response.data.data;
            this.totalRecords = response.data.meta.total
            this.perPage = response.data.meta.per_page
        },

        create(){
            this.$router.push({ name: 'users.create' });
        },

        edit(id){
            this.$router.push({ path: 'edit/' + id });
        }
    }
}
</script>

