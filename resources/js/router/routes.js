import MenuForm from "../components/Menu/MenuForm";
import Product from "../components/Product";
import MenuIndex from "../components/Menu/MenuIndex";
import MenuGrid from "../components/Menu/MenuGrid";
import UserForm from "../components/User/UserForm";
import UserIndex from "../components/User/UserIndex";
import UserGrid from "../components/User/UserGrid";
import LoginForm from "../components/LoginForm";

export default [
    {
        path: '/login',
        name: 'auth.login',
        component: LoginForm,
        meta: {
            auth: false,
        },
    },
    {
        path: '/',
        name: 'auth.login',
        component: LoginForm,
        meta: {
            auth: false,
        },
    },
    {
        path: '/menus',
        name: 'menus',
        component: MenuIndex,
        meta: {
            auth: true
        },
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
        meta: {
            auth: true
        },
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
        meta: {
            auth: true
        },
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
