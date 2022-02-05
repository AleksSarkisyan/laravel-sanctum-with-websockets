import { CartModel } from "@/src/models/Cart";

function state(): CartModel {
  return {
    products: [

    ],
    productItems: [ ],
    totalCartPrice: 0,
    totalCartQuantity: 0,
  }
};

export default state;
