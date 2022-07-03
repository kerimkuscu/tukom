<template>
  <div>
    <ConfirmDialog />

    <div class="pb-5" style="margin-bottom: 20px">
      <h4 class="float-start card-title">
        {{ $t('quote.title') }}
      </h4>
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
      <Column ref="first_name" field="first_name" :header="$t('quote.columns.first_name')" />
      <Column ref="last_name" field="last_name" :header="$t('quote.columns.last_name')" />
      <Column ref="title" field="title" :header="$t('quote.columns.title')" />
      <Column ref="business" field="business" :header="$t('quote.columns.business')" />
      <Column ref="company" field="company" :header="$t('quote.columns.company')" />
      <Column ref="address" field="address" :header="$t('quote.columns.address')" />
      <Column ref="city_state_zip_country" field="city_state_zip_country" :header="$t('quote.columns.zip_code')" />
      <Column ref="phone" field="phone" :header="$t('quote.columns.phone')" />
      <Column ref="fax" field="fax" :header="$t('quote.columns.fax')" />
      <Column ref="email" field="email" :header="$t('quote.columns.email')" />
      <Column ref="connector_interested_in" field="connector_interested_in" :header="$t('quote.columns.interested_connector')" />
      <Column ref="connector_supplier" field="connector_supplier" :header="$t('quote.columns.connector_supplier')" />
      <Column ref="eau" field="eau" :header="$t('quote.columns.eau')" />
      <Column ref="project_title" field="project_title" :header="$t('quote.columns.project_title')" />
      <Column ref="project_start_date" field="project_start_date" :header="$t('quote.columns.project_start_date')" />
      <Column ref="questions_comments" field="questions_comments" :header="$t('quote.columns.questions')" />

      <Column :body-style="{'text-align': 'center', overflow: 'visible'}">
        <template #body="{data}">
          <Button icon="pi pi-trash" class="float-end p-button-sm p-button-danger" @click="remove(data.id)" />
        </template>
      </Column>
    </DataTable>
  </div>
</template>

<script>
export default {
    name: 'QuoteGrid',

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
            const response = await this.$http.get('/api/quotes' + queryString)

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
                    await this.$http.delete('/api/quotes/' + id)
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
