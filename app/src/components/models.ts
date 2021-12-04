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
  name: string;
  email: string;
}

export type UserModel = {
  user: UserType
}

export enum API_PATHS {
  SANCTUM_COOKIE = 'sanctum/csrf-cookie',
  LOGIN = 'login',
  REGISTER = 'register',
  USER = 'api/user'
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
