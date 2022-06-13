<template>
    <div>
        <ConfirmDialog></ConfirmDialog>

        <div class="pb-5" style="margin-bottom: 20px">
            <h4 class="float-start card-title">Menus</h4>
            <Button label="Create" @click="create" class="float-end p-button-sm" />
        </div>

        <TreeTable v-if="menus.length > 0" :value="menus">
            <Column field="name" header="Name" :expander="true"></Column>

            <Column :bodyStyle="{'text-align': 'center', overflow: 'visible'}" >
                <template #body="item">
                    <Button icon="pi pi-trash" class="float-end p-button-sm p-button-danger" @click="remove(item.node.data.id)" />
                    <Button icon="pi pi-pencil" class="float-end p-button-sm p-button-secondary p-button-outlined mx-lg-1" @click="edit(item.node.data.id)" />
                </template>
            </Column>
        </TreeTable>
        <div v-else>
            <div class="alert alert-warning" role="alert">
                There is no record to display
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Menus",

    data: () => ({
       menus: null,
    }),

    mounted() {
      this.fetch();
    },

    methods: {
        async fetch(){
            const response = await this.$http.get('/api/menus')
            this.menus = response.data.data;
        },

        create(){
            this.$router.push({ name: 'menus.create' });
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
                    await this.$http.delete('/api/menus/' + id)
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
