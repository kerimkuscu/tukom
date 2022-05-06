import MenuForm from "./components/Menu/MenuForm";
import User from "./components/User";
import Product from "./components/Product";
import MenuIndex from "./components/Menu/MenuIndex";
import MenuGrid from "./components/Menu/MenuGrid";

export const routes = [
    {
        path: '/menus',
        name: 'menus',
        component: MenuIndex,
        children: [
            {
                path: '/',
                name: 'menus.grid',
                component: MenuGrid,
            },
            {
                path: 'edit/:id',
                name: 'menus.edit',
                component: MenuForm,
            },
            {
                path: 'create',
                name: 'menus.create',
                component: MenuForm,
            },
        ]
    },

    {
        path: '/users',
        name: 'users',
        component: User,
        // children: [
        //     {
        //         path: 'edit/:id',
        //         name: 'edit',
        //         component: UserForm,
        //     },
        //     {
        //         path: 'create',
        //         name: 'create',
        //         component: UserForm,
        //     },
        // ]
    },

    {
        path: '/products',
        name: 'products',
        component: Product,
        // children: [
        //     {
        //         path: 'edit/:id',
        //         name: 'edit',
        //         component: ProductForm,
        //     },
        //     {
        //         path: 'create',
        //         name: 'create',
        //         component: ProductForm,
        //     },
        // ]
    },
];
