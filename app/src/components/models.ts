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
  GET_CART = 'cart/get'
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
