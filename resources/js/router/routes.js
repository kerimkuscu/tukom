// Backend
import MenuForm from "../Backend/Pages/Menu/MenuForm";
import MenuIndex from "../Backend/Pages/Menu/MenuIndex";
import MenuGrid from "../Backend/Pages/Menu/MenuGrid";
import UserForm from "../Backend/Pages/User/UserForm";
import UserIndex from "../Backend/Pages/User/UserIndex";
import UserGrid from "../Backend/Pages/User/UserGrid";
import LoginForm from "../Backend/Pages/LoginForm";
import ProductIndex from "../Backend/Pages/Product/ProductIndex";
import ProductGrid from "../Backend/Pages/Product/ProductGrid";
import ProductForm from "../Backend/Pages/Product/ProductForm";
import NotFound from "../components/NotFound";

// Frontend

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

    //Frontend

    {path: '*', component: NotFound}
];
