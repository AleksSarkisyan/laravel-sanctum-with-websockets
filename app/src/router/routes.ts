import { RouteRecordRaw } from 'vue-router';

const routes: RouteRecordRaw[] = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
     // { path: '', component: () => import('pages/Index.vue') },
      { path: '', component: () => import('pages/Restaurant/Restaurant.vue') },
      // { path: '/restaurant/login', component: () => import('pages/Restaurant/RestaurantLogin.vue') },
      // { path: '/restaurant/dashboard', component: () => import('pages/Restaurant/Dashboard.vue') }

    ],
  },

  {
    path: '/restaurant',
    component: () => import('layouts/MainLayoutRestaurants.vue'),
    children: [
      { path: '', component: () => import('pages/Restaurant/Restaurant.vue') },
      { path: 'login', component: () => import('pages/Restaurant/RestaurantLogin.vue') },
      { path: 'dashboard', component: () => import('pages/Restaurant/Dashboard.vue') }

    ],
  },


  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/Error404.vue'),
  },
];

export default routes;
