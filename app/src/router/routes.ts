import { RouteRecordRaw } from 'vue-router';

const routes: RouteRecordRaw[] = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: () => import('pages/Frontend/Restaurant/Restaurant.vue') },
    ],
  },
  {
    path: '/restaurant',
    component: () => import('layouts/MainLayoutRestaurants.vue'),
    children: [
      { path: 'login', component: () => import('pages/RestaurantCms/Restaurant/RestaurantLogin.vue') },
      { path: 'dashboard', component: () => import('pages/RestaurantCms/Restaurant/Dashboard.vue') },
      { path: 'edit/:restaurantId', component: () => import('pages/RestaurantCms/Restaurant/Edit.vue') },
      { path: 'menus', component: () => import('pages/RestaurantCms/Menus/List.vue') },
      { path: 'menu/create', component: () => import('pages/RestaurantCms/Menus/Create.vue') },
      { path: 'menu/update/:menuId', component: () => import('pages/RestaurantCms/Menus/Update.vue') }
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
