import { MutationTree } from 'vuex';
import { CartModel } from "@/src/models/Cart";

const mutation: MutationTree<CartModel> = {

  clearCart(state:CartModel) {
    state.products = [];
    state.totalCartPrice = 0;
    state.totalCartQuantity = 0;
  },

  addToCart(state:CartModel, data) {
    const { totalCartPrice = 0, totalCartQuantity = 0  } = { ...data.additional }

    state.products = data.products;
    state.totalCartPrice = totalCartPrice;
    state.totalCartQuantity = totalCartQuantity;

    return state = {
      products: state.products,
      totalCartPrice: totalCartPrice,
      totalCartQuantity: totalCartQuantity
    }
  }
};

export default mutation;
