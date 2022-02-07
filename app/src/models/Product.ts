import { Category } from './Category';

export type Product = {
  data: ProductData
}

export type ProductData = {
  id?: number;
  name: string;
  category: Category;
  description: string;
  promoPrice: number | undefined;
  promo_price?: number | undefined;
  summedPrice?: string;
  quantity?: number;
  price: number;
  weight: string;
  isActive: boolean;
  is_active?: boolean | number;
}

export type ProductType = {
  id: number;
}

export type ProductItemsModel = {
  id: number;
  singlePrice: number;
  summedPrice: number;
  quantity: number;
}
