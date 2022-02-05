export type Product = {
  data: ProductData
}

export type ProductData = {
  id: number;
  name: string;
  description: string;
  promoPrice: string;
  summedPrice: string;
  quantity: number;
  price: number;
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
