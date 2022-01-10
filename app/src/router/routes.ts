import { RouteRecordRaw } from 'vue-router';

const routes: RouteRecordRaw[] = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: () => import('pages/Restaurant/Restaurant.vue') },
    ],
  },
  {
    path: '/restaurant',
    component: () => import('layouts/MainLayoutRestaurants.vue'),
    children: [
      { path: 'login', component: () => import('pages/Restaurant/RestaurantLogin.vue') },
      { path: 'dashboard', component: () => import('pages/Restaurant/Dashboard.vue') },
      { path: 'edit/:id', component: () => import('pages/Restaurant/Edit.vue') },
      { path: 'menus', component: () => import('pages/Restaurant/Menus/List.vue') }
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
