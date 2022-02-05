

export interface Todo {
  id: number;
  content: string;
}

export interface Meta {
  totalCount: number;
}

export enum Emits {
  UPDATE_MENU = 'updateMenu',
  CREATE_MENU = 'createMenu',
  GET_MENU = 'getMenu',
  CATEGORY_CREATED = 'categoryCreated'
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

export type SuccessResponse = {
  data: {
    success: boolean;
  }
}
