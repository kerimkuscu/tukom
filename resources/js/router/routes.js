import MenuForm from "../components/Menu/MenuForm";
import MenuIndex from "../components/Menu/MenuIndex";
import MenuGrid from "../components/Menu/MenuGrid";
import UserForm from "../components/User/UserForm";
import UserIndex from "../components/User/UserIndex";
import UserGrid from "../components/User/UserGrid";
import LoginForm from "../components/LoginForm";
import ProductIndex from "../components/Product/ProductIndex";
import ProductGrid from "../components/Product/ProductGrid";
import ProductForm from "../components/Product/ProductForm";
import NotFound from "../components/NotFound";

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
        redirect: 'products/'
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
        component: ProductIndex,
        meta: {
            auth: true
        },
        children: [
            {
                path: '/',
                name: 'products.grid',
                component: ProductGrid,
            },
            {
                path: 'edit/:id',
                name: 'products.edit',
                component: ProductForm,
            },
            {
                path: 'create',
                name: 'products.create',
                component: ProductForm,
            },
        ]
    },

    {path: '*', component: NotFound}
];
