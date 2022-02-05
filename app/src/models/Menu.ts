

import { Product } from './Product';

export type MenusType = {
  id: number;
  name: string;
  description: string;
  isActive: boolean | number;
}

export type MenuProducts = {
  products: Product[];
}


export type MenusModel = {
  menus: MenusType[],
}


export interface AvailableMenusProps {
  label: string;
  value: number;
}

export type AvailableMenus = {
  label: string;
  value: number;
}


export interface SelectedMenuProps {
  value: number;
}

export type MenuFormComponentData = {
  name: string;
  description: string;
  isActive?: number;
}

export type MenuFormModel = {
  menuFormData: MenuFormComponentData;
  menuFields?: MenuFormComponentData
}
