<template>
  <div>
    <ConfirmDialog />

    <div class="pb-5" style="margin-bottom: 20px">
      <h4 class="float-start card-title">
        {{ $t('brand.title') }}
      </h4>
      <Button :label="$t('messages.buttons.create')" class="float-end p-button-sm" @click="create" />
    </div>

    <DataTable
      ref="dt"
      data-key="id"
      responsive-layout="scroll"
      paginator-template="CurrentPageReport FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink"
      :value="items"
      :lazy="true"
      :paginator="true"
      :rows="perPage"
      :total-records="totalRecords"
      :loading="loading"
      @page="onPage($event)"
      @sort="onSort($event)"
    >
      <Column ref="name" field="name" :header="$t('brand.columns.name')" />
      <Column :header="$t('brand.columns.image')">
        <template #body="slotProps">
          <img :src="'/images/' + slotProps.data.image" :alt="slotProps.data.image" class="brands-image" style="height: 30px">
        </template>
      </Column>
      <Column :body-style="{'text-align': 'center', overflow: 'visible'}">
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
    name: 'BrandGrid',

    data: () => ({
        items: null,
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

            this.items = response.data.data;
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
                message: this.$i18n.t('messages.messages.delete_message'),
                header: this.$i18n.t('messages.buttons.delete'),
                icon: 'pi pi-exclamation-triangle',
                acceptClass: 'p-button-danger',
                rejectClass: 'p-button-secondary p-button-outlined',
                acceptLabel: this.$i18n.t('messages.buttons.delete'),
                rejectLabel: this.$i18n.t('messages.buttons.cancel'),
                accept: async () => {
                    const response = await this.$http.delete('/api/brands/' + id)
                    if(response.data.status){
                        this.$toast.add({ severity:'error', detail:this.$i18n.t('brand.messages.not_deleted'), life: 2000 });
                    }
                    else{
                        this.$toast.add({ severity:'success', detail: this.$i18n.t('brand.messages.deleted'), life: 2000 });
                    }

                    await this.fetch()
                },
                reject: () => {
                    //callback to execute when user rejects the action
                }
            });
        },
    }
}
</script>

