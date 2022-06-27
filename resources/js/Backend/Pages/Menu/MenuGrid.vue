<template>
  <div>
    <ConfirmDialog />
    <Toast position="top-right" />

    <div class="pb-5" style="margin-bottom: 20px">
      <h4 class="float-start card-title">
        Menus
      </h4>
      <Button label="Create" class="float-end p-button-sm" @click="create" />
    </div>

    <TreeTable v-if="menus.length > 0" :value="menus">
      <Column field="name" header="Name" :expander="true" />

      <Column :body-style="{'text-align': 'center', overflow: 'visible'}">
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
import Toast from 'primevue/toast';

export default {
    name: 'Menus',

    components : {
        Toast
    },

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
                message: this.$i18n.t('messages.messages.delete_message'),
                header: this.$i18n.t('messages.buttons.delete'),
                icon: 'pi pi-exclamation-triangle',
                acceptClass: 'p-button-danger',
                rejectClass: 'p-button-secondary p-button-outlined',
                acceptLabel: this.$i18n.t('messages.buttons.delete'),
                rejectLabel: this.$i18n.t('messages.buttons.cancel'),
                accept: async () => {
                    const response = await this.$http.delete('/api/menus/' + id)
                    if(response.data.status){
                        this.$toast.add({ severity:'success', summary: 'Success', detail:'Menu deleted.', life: 1000 });
                    }
                    else{
                        this.$toast.add({ severity:'error', summary: 'Error', detail:'Parent menu cannot be deleted.', life: 1000 });
                    }

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
