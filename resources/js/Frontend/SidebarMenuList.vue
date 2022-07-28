<template>
  <div class="p-panelmenu p-component">
    <template v-for="(item, index) of model">
      <div :key="item.label + '_' + index" class="p-panelmenu-panel">

        <div class="p-component p-panelmenu-header">
            <a class="p-panelmenu-header-link">
                <span v-if="item.items" :class="getPanelToggleIcon(item)" @click="onItemClick($event, item)" />
                <a @click="onItemClickForSubMenu($event, item)"><span class="p-menuitem-text">{{ item.label }}</span></a>
            </a>
        </div>

        <transition name="p-toggleable-content">
          <div v-show="item === activeItem" class="p-toggleable-content" role="region">
            <div v-if="item.items" class="p-panelmenu-content">
                <SidebarSubMenuList :model="item" class="p-panelmenu-root-submenu" />
            </div>
          </div>
        </transition>
      </div>
    </template>
  </div>
</template>

<script>

import SidebarSubMenuList from  './SidebarSubMenuList';

export default {
    props: {
        model: {
            type: Array,
            default: null
        },
        exact: {
            type: Boolean,
            default: true
        }
    },

    components: {
        SidebarSubMenuList
    },

    data() {
        return {
            activeItem: null,
            activeSubItem: null,
            productName: null
        }
    },
    methods: {
        onItemClick(event, item) {
                this.activeItem = item;
        },

        onItemClickForSubMenu(event, item) {
                this.activeSubItem = item;
                this.$eventHub.$emit('sub-menu-item', item.id);
                let urlProductName = item.label;
                urlProductName = urlProductName.replace(/\s+/g, '-').toLowerCase();
                let itemId = item.id;
                this.$router.push({ name: 'products', params: { productName: urlProductName,  id: itemId } });

        },

        getPanelToggleIcon(item) {
            const active = item === this.activeItem;
            return ['p-panelmenu-icon pi', { 'pi-chevron-right': !active,' pi-chevron-down': active }];
        },

        getSubmenuIcon(item) {
            console.log('hede ');
            const active = item === this.activeSubItem;
            return ['p-panelmenu-icon pi pi-fw', { 'pi-angle-right': !active, 'pi-angle-down': active }];
        },
    },
}
</script>

<style>
.p-panelmenu .p-panelmenu-header-link {
    display: flex;
    align-items: center;
    user-select: none;
    cursor: pointer;
    position: relative;
    text-decoration: none;
}

.p-panelmenu .p-panelmenu-header-link:focus {
    z-index: 1;
}

.p-panelmenu .p-menuitem-text {
    line-height: 1;
}

.p-panelmenu-icon:hover {
    background-color: #cac7c7;
    border-radius: 50px;
    padding: 2px;
}
</style>
