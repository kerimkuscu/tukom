<template>
  <ul class="p-submenu-list" role="tree">
    <template v-for="(item, i) of model.items">
      <li :key="item.label + i" class="p-menuitem">
        <a class="p-menuitem-link" role="treeitem">
          <span v-if="item.items" :class="getSubmenuIcon(item)" @click="onItemClickForSubMenu($event, item)" />
          <a>
            <span class="p-menuitem-text" @click="updateRoute(item)">{{ item.label }}</span>
          </a>
        </a>
        <transition name="p-toggleable-content">
          <div v-show="item === activeSubItem" class="p-toggleable-content">
            <SidebarSubMenuList v-if="item.items" :key="item.label + '_sub_'" :model="item" />
          </div>
        </transition>
      </li>
    </template>
  </ul>
</template>

<script>
export default {
    name: 'SidebarSubMenuList',

    props: {
        model: {
            type: Object | Array,
            default: null
        },
    },

    data() {
        return {
            activeSubItem: null,
        }
    },

    methods: {
        onItemClickForSubMenu(event, item) {
            this.activeSubItem = item;
        },

        updateRoute(item){
            this.$eventHub.$emit('sub-menu-item', item.id);

            let urlProductName = item.label;
            urlProductName = urlProductName.replace(/\s+/g, '-').toLowerCase();
            let itemId = item.id;
            this.$router.push({ name: 'products', params: { productName: urlProductName,  id: itemId } });
        },

        getSubmenuIcon(item) {
            const active = item === this.activeSubItem;
            return ['p-panelmenu-icon pi pi-fw', { 'pi-angle-right': !active, 'pi-angle-down': active }];
        },
    }
}
</script>

<style scoped>
.p-panelmenu .p-submenu-list {
    margin: 0;
    padding: 0;
    list-style: none;
}

.p-panelmenu .p-menuitem-link {
    display: flex;
    align-items: center;
    user-select: none;
    cursor: pointer;
    text-decoration: none;
}
</style>
