// Backend
import LoginForm from "../Backend/Pages/LoginForm";

import MenuIndex from "../Backend/Pages/Menu/MenuIndex";
import MenuGrid from "../Backend/Pages/Menu/MenuGrid";
import MenuForm from "../Backend/Pages/Menu/MenuForm";

import UserIndex from "../Backend/Pages/User/UserIndex";
import UserGrid from "../Backend/Pages/User/UserGrid";
import UserForm from "../Backend/Pages/User/UserForm";

import ProductIndex from "../Backend/Pages/Product/ProductIndex";
import ProductGrid from "../Backend/Pages/Product/ProductGrid";
import ProductForm from "../Backend/Pages/Product/ProductForm";

import BrandIndex from '../Backend/Pages/Brand/BrandIndex';
import BrandGrid from '../Backend/Pages/Brand/BrandGrid';
import BrandForm from '../Backend/Pages/Brand/BrandForm';

import NotFound from "../components/NotFound";

// Frontend

import Index from '../Frontend/Pages/Index';
import Communication from '../Frontend/Pages/Communication';

export default [
    //Backend
    {
        path: '/login',
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

    {
        path: '/brands',
        name: 'brands',
        component: BrandIndex,
        meta: {
            auth: true
        },
        children: [
            {
                path: '/',
                name: 'brands.grid',
                component: BrandGrid,
            },
            {
                path: 'edit/:id',
                name: 'brands.edit',
                component: BrandForm,
            },
            {
                path: 'create',
                name: 'brands.create',
                component: BrandForm,
            },
        ]
    },

    //Frontend

    {
        path: '/',
        name: 'index',
        component: Index,
        meta: {
            auth: false
        },
    },

    {
        path: '/communication',
        name: 'communication',
        component: Communication,
        meta: {
            auth: false
        },
    },



    {path: '*', component: NotFound}
];
