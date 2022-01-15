import { CartModel } from "@/src/components/models";

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
