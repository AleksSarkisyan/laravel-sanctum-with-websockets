import { Product, ProductItemsModel } from "./Product"

export type CartModel = {
  products: Product[],
  productItems: ProductItemsModel[],
  totalCartPrice: number;
  totalCartQuantity: number;
}
