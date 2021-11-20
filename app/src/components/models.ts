export interface Todo {
  id: number;
  content: string;
}

export interface Meta {
  totalCount: number;
}


export interface LoginFormData {
  email: string;
  password: string;
}

export interface User {
  name: string;
  email: string;
}

export type UserType = {
  name: string;
  email: string;
}
