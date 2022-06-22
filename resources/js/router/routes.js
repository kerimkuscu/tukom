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
import Contact from '../Frontend/Pages/Contact';
import About from '../Frontend/Pages/About';
import Quote from '../Frontend/Pages/Quote';
import Products from '../Frontend/Pages/Products';
import ProductList from '../Frontend/Pages/ProductList';

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
        path: '/products-list',
        name: 'products-list',
        component: ProductIndex,
        meta: {
            auth: true
        },
        children: [
            {
                path: '/',
                name: 'products-list.grid',
                component: ProductGrid,
            },
            {
                path: 'edit/:id',
                name: 'products-list.edit',
                component: ProductForm,
            },
            {
                path: 'create',
                name: 'products-list.create',
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
        path: '/products',
        name: 'products',
        component: Products,
        meta: {
            auth: false
        },
        children: [
            {
                path: ':id',
                name: 'products-lists',
                component: ProductList,
            },
        ]
    },
    {
        path: '/contact',
        name: 'contact',
        component: Contact,
        meta: {
            auth: false
        },
    },
    {
        path: '/about',
        name: 'about',
        component: About,
        meta: {
            auth: false
        },
    },
    {
        path: '/quote',
        name: 'quote',
        component: Quote,
        meta: {
            auth: false
        },
    },



    {path: '*', component: NotFound}
];
