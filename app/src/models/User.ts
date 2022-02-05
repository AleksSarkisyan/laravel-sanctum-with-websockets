import { Ref } from 'vue';

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

export type UserModel = {
  user: UserType,
  initialUserState: UserType,
}

export type RestaurantUserModel = {
  user: UserType,
  initialUserState: UserType,
}
