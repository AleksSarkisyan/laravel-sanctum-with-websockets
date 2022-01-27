import { Ref } from 'vue';

export interface Todo {
  id: number;
  content: string;
}

export interface Meta {
  totalCount: number;
}

export interface LoginFormData {
  email: Ref<string>;
  password: Ref<string>;
}

export interface User {
  name: string;
  email: string;
}

export type UserType = {
  id: number | null;
  name: string;
  email: string;
}

export type MenusType = {
  name: string;
  description: string;
  isActive: boolean;
}

export type UserModel = {
  user: UserType,
  initialUserState: UserType,
}

export type RestaurantUserModel = {
  user: UserType,
  initialUserState: UserType,
}

export type MenusModel = {
  menus: MenusType[],
}

export enum API_PATHS {
  SANCTUM_COOKIE = 'sanctum/csrf-cookie',
  LOGIN = 'api/login',
  LOGOUT = 'api/logout',
  REGISTER = 'register',
  USER = 'api/user',
  RESTAURANT_USER_LOGIN = 'api/restaurant/login',
  RESTAURANT_GET_USER_MENUES = 'api/restaurant-cms/menu/get-all',
  RESTAURANT_CMS_PATH = 'api/restaurant-cms',
  ADD_TO_CART = 'cart/add',
  GET_CART = 'cart/get',
  RESTAURANT_ORDERS = 'api/restaurant-cms/order/restaurant-orders',
  CONFIRM_ORDER = 'api/restaurant-cms/order/confirm',
  RESTAURANT_ALL_CATEGORIES = 'api/restaurant-cms/category/get-all',
  RESTAURANT_CATEGORY = 'api/restaurant-cms/category/get',
  RESTAURANT_CREATE_CATEGORY = 'api/restaurant-cms/category/create',
  RESTAURANT_ALL_PRODUCTS = 'api/restaurant-cms/product/get-all',
  RESTAURANT_PRODUCT = 'api/restaurant-cms/product/get',
  RESTAURANT_CREATE_PRODUCT = 'api/restaurant-cms/product/create',
  RESTAURANT_UPDATE_PRODUCT = 'api/restaurant-cms/product/update',
}

export enum RestaurantMenuPaths {
  UPDATE = '/menu/update',
  CREATE = '/menu/create',
  SAVE = '/menu/save',
  GET = '/menu/get'
}

export const RestaurantMenuRoutes = {
  UPDATE: `${API_PATHS.RESTAURANT_CMS_PATH}${RestaurantMenuPaths.UPDATE}`,
  CREATE: `${API_PATHS.RESTAURANT_CMS_PATH}${RestaurantMenuPaths.CREATE}`,
  SAVE: `${API_PATHS.RESTAURANT_CMS_PATH}${RestaurantMenuPaths.SAVE}`,
  GET: `${API_PATHS.RESTAURANT_CMS_PATH}${RestaurantMenuPaths.GET}`
}

export type AxiosCall = {
  method: HTTP_METHODS,
  path: string,
  data?: object|null
}

export enum HTTP_METHODS {
  Get = 'GET',
  Post = 'POST'
}

export type AxiosErrors = {
  errors: [],
  message: string
}

export type AxiosModel = {
  error: AxiosErrors
}

export interface EditRestaurantComponentData {
  selectedMenu: number | SelectedMenuProps;
  availableMenus: AvailableMenusProps[];
  restaurant: Restaurant;
}

export interface AvailableMenusProps {
  label: string;
  value: number;
}

export interface SelectedMenuProps {
  value: number;
}

export type Restaurant = {
  data: {
    restaurant: {
      id: number;
      user_id: number;
      menu_id: number;
      name: string;
      city: string;
    }
  }
}

export type ProductType = {
  id: number;
}

export type CartModel = {
  products: any[],
  productItems: any[],
  totalCartPrice: number;
  totalCartQuantity: number;
}
