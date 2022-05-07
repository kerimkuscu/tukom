import MenuForm from "./components/Menu/MenuForm";
import Product from "./components/Product";
import MenuIndex from "./components/Menu/MenuIndex";
import MenuGrid from "./components/Menu/MenuGrid";
import UserForm from "./components/User/UserForm";
import UserIndex from "./components/User/UserIndex";
import UserGrid from "./components/User/UserGrid";

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
        component: UserIndex,
        children: [
            {
                path: '/',
                name: 'users.grid',
                component: UserGrid,
            },
            {
                path: 'edit/:id',
                name: 'users.edit',
                component: UserForm,
            },
            {
                path: 'create',
                name: 'users.create',
                component: UserForm,
            },
        ]
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
