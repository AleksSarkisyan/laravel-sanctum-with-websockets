import { GetterTree } from 'vuex';
import { StateInterface } from '../index';
import { CartModel } from "@/src/models/Cart";

const getters: GetterTree<CartModel, StateInterface> = {
  getCart (context) {
    return context.products
  },
  getProductItems (context) {
    return context.productItems
  },
  getTotalCartPrice(context) {
    return context.totalCartPrice
  },
  getTotalCartQuantity(context) {
    return context.totalCartQuantity
  }

};

export default getters;
