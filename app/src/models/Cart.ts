import { Product } from "./Product"

export type CartModel = {
  products: Product[];
  totalCartPrice: number;
  totalCartQuantity: number;
}
