<template>
  <div class="p-panelmenu p-component">
    <template v-for="(item, index) of model">
      <div :key="item.label + '_' + index" class="p-panelmenu-panel">
        <div class="p-component p-panelmenu-header">
          <a href="#" class="p-panelmenu-header-link" @click="onItemClick($event, item)">
            <span v-if="item.items" :class="getPanelToggleIcon(item)" />
            <span class="p-menuitem-text">{{ item.label }}</span>
          </a>
        </div>
        <transition name="p-toggleable-content">
          <div v-show="item === activeItem" class="p-toggleable-content" role="region">
            <div v-if="item.items" class="p-panelmenu-content">
              <div class="p-panelmenu-root-submenu">
                <ul class="p-submenu-list" role="tree">
                  <template v-for="(item, i) of item.items">
                    <li :key="item.label + i" class="p-menuitem">
                      <a class="p-menuitem-link" role="treeitem" @click="onItemClickForSubMenu($event, item)">
                        <span v-if="item.items" :class="getSubmenuIcon(item)" />
                        <span class="p-menuitem-text">{{ item.label }}</span>
                      </a>
                    </li>
                  </template>
                </ul>
              </div>
            </div>
          </div>
        </transition>
      </div>
    </template>
  </div>
</template>

<script>

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
                let productName = item.label;
                productName = productName.replace(/\s+/g, '-').toLowerCase();
                this.$router.push({ name: 'products', params: { productName } });

        },

        getPanelToggleIcon(item) {
            const active = item === this.activeItem;
            return ['p-panelmenu-icon pi', { 'pi-chevron-right': !active,' pi-chevron-down': active }];
        },

        getSubmenuIcon(item) {
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

.p-panelmenu .p-menuitem-text {
    line-height: 1;
}
</style>
