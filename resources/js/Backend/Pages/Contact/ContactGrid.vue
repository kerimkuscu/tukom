<template>
  <div>
    <ConfirmDialog />

    <ContactSettings />

    <div class="pb-5" style="margin-bottom: 20px">
      <h4 class="float-start card-title">
        {{ $t('contact.backend.title') }}
      </h4>

      <Button :label="$t('messages.buttons.contact_settings')" class="float-end p-button-sm p-button-outlined p-button-secondary" @click="contactSettingsModal" />
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
      <Column ref="name" field="name" :header="$t('contact.backend.columns.name')" />
      <Column ref="email" field="email" :header="$t('contact.backend.columns.email')" />
      <Column ref="phone" field="phone" :header="$t('contact.backend.columns.phone')" />
      <Column ref="subject" field="subject" :header="$t('contact.backend.columns.subject')" />
      <Column ref="message" field="message" :header="$t('contact.backend.columns.message')" />

      <Column :body-style="{'text-align': 'center', overflow: 'visible'}">
        <template #body="{data}">
          <Button icon="pi pi-trash" class="float-end p-button-sm p-button-danger" @click="remove(data.id)" />
        </template>
      </Column>
    </DataTable>
  </div>
</template>

<script>
import ContactSettings from './ContactSettings';
export default {
    name: 'ContactGrid',

    components: {
        ContactSettings
    },

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
            const response = await this.$http.get('/api/contacts' + queryString)

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
                    const response = await this.$http.delete('/api/contacts/' + id)
                    if(response.data.status){
                        this.$toast.add({ severity:'success', detail: this.$i18n.t('backend.contact.messages.deleted'), life: 2000 });
                    }
                    else{
                        this.$toast.add({ severity:'error', detail:this.$i18n.t('backend.contact.messages.not_deleted'), life: 2000 });
                    }

                    await this.fetch()
                },
                reject: () => {
                    //callback to execute when user rejects the action
                }
            });
        },

        contactSettingsModal() {
            this.$eventHub.$emit('contact-settings');
        }
    }
}
</script>
