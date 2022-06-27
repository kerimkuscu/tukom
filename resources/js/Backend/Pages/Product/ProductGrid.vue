<template>
  <div>
    <ConfirmDialog />

    <Toast position="top-right" />

    <Dialog position="right" :visible.sync="display">
      <template #header>
        <h3>{{ menuModalHeader }}</h3>
      </template>

      <div class="row" style="padding: 0 1.5rem 17rem 1.5rem;">
        <div class="col-md-12 grid p-fluid">
          <Dropdown
            v-model="menu"
            :options="menuList"
            option-label="text"
            option-value="value"
            placeholder="(Select Menu)"
            :filter="true"
          />
        </div>
      </div>

      <template #footer>
        <Button label="Cancel" class="p-button-outlined p-button-secondary p-button-sm" @click="closeMenuModal" />
        <Button label="Save" class=" p-button-sm" @click="saveMenu" />
      </template>
    </Dialog>

    <div class="pb-5" style="margin-bottom: 20px">
      <h4 class="float-start card-title">
        Products
      </h4>
      <Button label="Create" class="float-end p-button-sm" @click="create" />

      <FileUpload
        mode="basic"
        :auto="true"
        choose-label="Import"
        name="demo[]"
        :custom-upload="true"
        accept=".xlsx, .xls, .csv"
        style="float:right;padding-right: 3px;"
        button-class="p-button-sm p-button-outlined p-button-secondary"
        @uploader="importProducts"
      />
    </div>

    <DataTable
      ref="dt"
      data-key="id"
      responsive-layout="scroll"
      :scrollable="true"
      edit-mode="cell"
      :rows="perPage"
      :rows-per-page-options="[15,25,50,100]"
      paginator-template="CurrentPageReport FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink RowsPerPageDropdown"
      scroll-height="1500px"
      scroll-direction="both"
      :resizable-columns="true"
      column-resize-mode="expand"
      :value="products"
      :lazy="true"
      :paginator="true"
      :total-records="totalRecords"
      :loading="loading"
      filter-display="row"
      :filters.sync="filters"
      :global-filter-fields="['name','email']"
      @cell-edit-complete="onCellEditComplete"
      @page="onPage($event)"
      @sort="onSort($event)"
      @filter="onFilter($event)"
    >
      <Column
        ref="card_code"
        field="card_code"
        header="Card Code"
        filter-match-mode="startsWith"
        :sortable="true"
        :styles="{'min-width':'400px'}"
      >
        <template #filter="{filterModel,filterCallback}">
          <InputText v-model="filterModel.value" type="text" class="p-column-filter" placeholder="Search by card code" @keydown.enter="filterCallback" />
        </template>

        <template #body="slotProps">
          <p :title="slotProps.data.card_code" class="truncate">
            {{ slotProps.data.card_code }}
          </p>
        </template>

        <template #body="slotProps">
          <router-link :to="{ path: 'edit/' + slotProps.data.id }">
            {{ slotProps.data.card_code }}
          </router-link>
        </template>
      </Column>

      <Column
        ref="description"
        field="description"
        header="Description"
        filter-field="description"
        filter-match-mode="contains"
        :sortable="true"
        :styles="{'min-width':'400px'}"
      >
        <template #filter="{filterModel,filterCallback}">
          <InputText v-model="filterModel.value" type="text" class="p-column-filter" placeholder="Search by description" @keydown.enter="filterCallback" />
        </template>

        <template #body="slotProps">
          <p :title="slotProps.data.description" class="truncate">
            {{ slotProps.data.description }}
          </p>
        </template>
      </Column>

      <Column
        ref="type"
        field="type"
        header="Type"
        filter-field="type"
        filter-match-mode="contains"
        :sortable="true"
        :styles="{'min-width':'400px'}"
      >
        <template #filter="{filterModel,filterCallback}">
          <InputText v-model="filterModel.value" type="text" class="p-column-filter" placeholder="Search by type" @keydown.enter="filterCallback" />
        </template>

        <template #body="slotProps">
          <p :title="slotProps.data.type" class="truncate">
            {{ slotProps.data.type }}
          </p>
        </template>
      </Column>

        <Column field="menu" header="Menu" :styles="{'min-width':'200px'}">
            <template #body="slotProps">
                <p :title="slotProps.data.menu" class="truncate">
                    {{ slotProps.data.menu }}
                </p>
            </template>
        </Column>

      <Column field="brand" header="Brand" :styles="{'min-width':'200px'}">
        <template #body="slotProps">
          <p :title="slotProps.data.brand" class="truncate">
            {{ slotProps.data.brand }}
          </p>
        </template>
      </Column>

      <Column field="fiili_stok" header="Fiili Stok" :styles="{'min-width':'200px'}">
        <template #body="slotProps">
          <p :title="slotProps.data.fiili_stok" class="truncate">
            {{ slotProps.data.fiili_stok }}
          </p>
        </template>
      </Column>

      <Column field="actual_stock" header="Actual Stock" :styles="{'min-width':'200px'}">
        <template #body="slotProps">
          <p :title="slotProps.data.actual_stock" class="truncate">
            {{ slotProps.data.actual_stock }}
          </p>
        </template>
      </Column>

      <Column field="main_unit" header="Main Unit" :styles="{'min-width':'200px'}">
        <template #body="slotProps">
          <p :title="slotProps.data.main_unit" class="truncate">
            {{ slotProps.data.main_unit }}
          </p>
        </template>
      </Column>

      <Column field="price" header="Price" :styles="{'min-width':'200px'}">
        <template #body="slotProps">
          <p :title="slotProps.data.price" class="truncate">
            {{ slotProps.data.price }}
          </p>
        </template>
      </Column>

      <Column field="currency" header="Currency" :styles="{'min-width':'200px'}">
        <template #body="slotProps">
          <p :title="slotProps.data.currency" class="truncate">
            {{ slotProps.data.currency }}
          </p>
        </template>
      </Column>

      <Column field="group_code" header="Group Code" :styles="{'min-width':'200px'}">
        <template #body="slotProps">
          <p :title="slotProps.data.group_code" class="truncate">
            {{ slotProps.data.group_code }}
          </p>
        </template>
      </Column>

      <Column field="special_code_1" header="Special Code 1" :styles="{'min-width':'200px'}">
        <template #body="slotProps">
          <p :title="slotProps.data.special_code_1" class="truncate">
            {{ slotProps.data.special_code_1 }}
          </p>
        </template>
      </Column>

      <Column field="special_code_2" header="Special Code 2" :styles="{'min-width':'200px'}">
        <template #body="slotProps">
          <p :title="slotProps.data.special_code_2" class="truncate">
            {{ slotProps.data.special_code_2 }}
          </p>
        </template>
      </Column>

      <Column field="special_code_3" header="Special Code 3" :styles="{'min-width':'200px'}">
        <template #body="slotProps">
          <p :title="slotProps.data.special_code_3" class="truncate">
            {{ slotProps.data.special_code_3 }}
          </p>
        </template>
      </Column>

      <Column field="special_code_4" header="Special Code 4" :styles="{'min-width':'200px'}">
        <template #body="slotProps">
          <p :title="slotProps.data.special_code_4" class="truncate">
            {{ slotProps.data.special_code_4 }}
          </p>
        </template>
      </Column>

      <Column field="special_code_5" header="Special Code 5" :styles="{'min-width':'200px'}">
        <template #body="slotProps">
          <p :title="slotProps.data.special_code_5" class="truncate">
            {{ slotProps.data.special_code_5 }}
          </p>
        </template>
      </Column>

      <Column field="special_code_6" header="Special Code 6" :styles="{'min-width':'200px'}">
        <template #body="slotProps">
          <p :title="slotProps.data.special_code_6" class="truncate">
            {{ slotProps.data.special_code_6 }}
          </p>
        </template>
      </Column>

      <Column field="special_code_7" header="Special Code 7" :styles="{'min-width':'200px'}">
        <template #body="slotProps">
          <p :title="slotProps.data.special_code_7" class="truncate">
            {{ slotProps.data.special_code_7 }}
          </p>
        </template>
      </Column>

      <Column field="special_code_8" header="Special Code 8" :styles="{'min-width':'200px'}">
        <template #body="slotProps">
          <p :title="slotProps.data.special_code_8" class="truncate">
            {{ slotProps.data.special_code_8 }}
          </p>
        </template>
      </Column>

      <Column field="special_code_9" header="Special Code 9" :styles="{'min-width':'200px'}">
        <template #body="slotProps">
          <p :title="slotProps.data.special_code_9" class="truncate">
            {{ slotProps.data.special_code_9 }}
          </p>
        </template>
      </Column>

      <Column field="special_code_10" header="Special Code 10" :styles="{'min-width':'200px'}">
        <template #body="slotProps">
          <p :title="slotProps.data.special_code_10" class="truncate">
            {{ slotProps.data.special_code_10 }}
          </p>
        </template>
      </Column>

      <Column :exportable="false" :styles="{'min-width':'8rem'}">
        <template #body="{data}">
          <Button icon="pi pi-bars" class="p-button-sm p-button-secondary p-button-outlined mx-lg-1" @click="showMenuModal(data)" />
          <Button icon="pi pi-pencil" class="p-button-sm p-button-secondary p-button-outlined mx-lg-1" @click="edit(data.id)" />
          <Button icon="pi pi-trash" class="p-button-sm p-button-danger" @click="remove(data.id)" />
        </template>
      </Column>
    </DataTable>
  </div>
</template>

<script>
import Toast from 'primevue/toast';

export default {
    name: 'ProductGrid',

    components : {
        Toast
    },

    data: () => ({
        products: null,
        loading: false,
        totalRecords: 0,
        perPage: 15,
        lazyParams: {},

        filters: {
            'card_code': { value: '', matchMode: 'contains' },
            'description': { value: '', matchMode: 'contains' },
            'type': { value: '', matchMode: 'contains' },
        },

        menu: null,
        menuList: [],
        display: false,
        menuModalHeader: null,
        selectedId: null
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

        this.getMenus();
    },

    methods: {
        onCellEditComplete(){

        },
        async fetch(){
            this.loading = true;

            const queryString = `?page=${this.lazyParams.page + 1 || ''}&sort=${this.lazyParams.sortField || '' }&sortOrder=${this.lazyParams.sortOrder || ''}&card_code=${this.lazyParams.filters.card_code.value || ''}&description=${this.lazyParams.filters.description.value || ''}&type=${this.lazyParams.filters.type.value || ''}&per_page=${this.lazyParams.rows}`

            const response = await this.$http.get('/api/products' + queryString)

            this.products = response.data.data;
            this.totalRecords = response.data.meta.total
            this.perPage = response.data.meta.per_page

            this.loading = false;

        },

        async getMenus(){
            const response = await this.$http.get('/api/menus/getMenuList')
            this.menuList = response.data.data;
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
            this.$router.push({ name: 'products-list.create' });
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
                    await this.$http.delete('/api/products/' + id)
                    this.$toast.add({ severity:'success', detail:'Product Deleted', life: 1000 });
                    await this.fetch();
                },
                reject: () => {
                    //callback to execute when user rejects the action
                }
            });
        },

        async importProducts(event){
            this.loading = true

                let formData = new FormData();
                let file = event.files[0];
                formData.append('file', file);

                const response = await this.$http.post('/api/products/import', formData,  { headers: { 'Content-Type': 'multipart/form-data' } });

                response.status === 200 ? this.fetch() : this.$toast.add({ severity:'error', summary: 'Please try again later', detail:'Order submitted', life: 3000 });

            this.loading = false;
        },

        showMenuModal(item) {
            this.menuHeader(item);
            this.selectedId = item.id;
            this.display = true;
        },

        menuHeader(item) {
            this.menuModalHeader = item.card_code + '-' + item.description;
        },

        closeMenuModal() {
            this.display = false;
            this.menuModalHeader = null;
        },

        async saveMenu() {
            let formData = new FormData();
            formData.append('menu_id', this.menu);

            const response = await this.$http.post(`/api/products/${this.selectedId}/menu`,formData);

            if(response.data.status){
                await this.fetch();
                this.$toast.add({ severity:'success', detail:'Menu saved.', life: 1000 })
            }
            else {
                this.$toast.add({ severity:'error', detail:'Menu could not saved.', life: 1000 });
            }

            this.display = false;
            this.menuModalHeader = null;
        }
    }
}
</script>

<style>
.p-fileupload-choose:not(.p-disabled):hover {
    background: rgba(100, 116, 139, 0.04) !important;
    color: #64748B !important;
    border: 1px solid !important;
}
</style>
