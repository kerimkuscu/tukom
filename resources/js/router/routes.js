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

import CarouselIndex from '../Backend/Pages/Carousel/CarouselIndex';
import CarouselGrid from '../Backend/Pages/Carousel/CarouselGrid';
import CarouselForm from '../Backend/Pages/Carousel/CarouselForm';

import FirmIndex from '../Backend/Pages/Firm/FirmIndex';
import FirmGrid from '../Backend/Pages/Firm/FirmGrid';
import FirmForm from '../Backend/Pages/Firm/FirmForm';

import MarketIndex from '../Backend/Pages/Market/MarketIndex';
import MarketGrid from '../Backend/Pages/Market/MarketGrid';
import MarketForm from '../Backend/Pages/Market/MarketForm';

import BrandIndex from '../Backend/Pages/Brand/BrandIndex';
import BrandGrid from '../Backend/Pages/Brand/BrandGrid';
import BrandForm from '../Backend/Pages/Brand/BrandForm';

import AboutForm from '../Backend/Pages/About/AboutForm';

import QuoteIndex from '../Backend/Pages/Quote/QuoteIndex';
import QuoteGrid from '../Backend/Pages/Quote/QuoteGrid';

import ContactIndex from '../Backend/Pages/Contact/ContactIndex';
import ContactGrid from '../Backend/Pages/Contact/ContactGrid';

import NotFound from "../components/NotFound";

// Frontend

import Index from '../Frontend/Pages/Home/Index';
import Search from '../Frontend/Pages/Search/Search';
import Contact from '../Frontend/Pages/Contact/Contact';
import About from '../Frontend/Pages/About/About';
import Quote from '../Frontend/Pages/Quote/Quote';
import Products from '../Frontend/Pages/Home/Products';
import ProductsDetails from '../Frontend/Pages/Home/ProductsDetails';

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
        path: '/carousels',
        name: 'carousels',
        component: CarouselIndex,
        meta: {
            auth: true
        },
        children: [
            {
                path: '/',
                name: 'carousels.grid',
                component: CarouselGrid,
            },
            {
                path: 'edit/:id',
                name: 'carousels.edit',
                component: CarouselForm,
            },
            {
                path: 'create',
                name: 'carousels.create',
                component: CarouselForm,
            },
        ]
    },

    {
        path: '/firms',
        name: 'firms',
        component: FirmIndex,
        meta: {
            auth: true
        },
        children: [
            {
                path: '/',
                name: 'firms.grid',
                component: FirmGrid,
            },
            {
                path: 'edit/:id',
                name: 'firms.edit',
                component: FirmForm,
            },
            {
                path: 'create',
                name: 'firms.create',
                component: FirmForm,
            },
        ]
    },

    {
        path: '/markets',
        name: 'markets',
        component: MarketIndex,
        meta: {
            auth: true
        },
        children: [
            {
                path: '/',
                name: 'markets.grid',
                component: MarketGrid,
            },
            {
                path: 'edit/:id',
                name: 'markets.edit',
                component: MarketForm,
            },
            {
                path: 'create',
                name: 'markets.create',
                component: MarketForm,
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

    {
        path: '/abouts',
        name: 'abouts.form',
        component: AboutForm,
        meta: {
            auth: true
        },
    },

    {
        path: '/quotes',
        name: 'quotes',
        component: QuoteIndex,
        meta: {
            auth: true
        },
        children: [
            {
                path: '/',
                name: 'quotes.grid',
                component: QuoteGrid,
            }
        ]
    },

    {
        path: '/contacts',
        name: 'contacts',
        component: ContactIndex,
        meta: {
            auth: true
        },
        children: [
            {
                path: '/',
                name: 'contacts.grid',
                component: ContactGrid,
            }
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
        path: '/products/:productName/:id',
        name: 'products',
        component: Products,
        meta: {
            auth: false
        }
    },
    {
        path: '/products-details/:productName/:productId',
        name: 'products.details',
        component: ProductsDetails,
        meta: {
            auth: false
        }
    },
    {
        path: '/search',
        name: 'search',
        component: Search,
        meta: {
            auth: false
        },
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
