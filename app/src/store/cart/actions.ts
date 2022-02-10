import { ActionTree } from 'vuex';
import { StateInterface } from '../index';
import { CartRoutes } from '../../models/ApiPaths';
import { CartModel } from "@/src/models/Cart";
import { api } from '../../boot/axios';

const actions: ActionTree<CartModel, StateInterface> = {

  async addToCart (context, payload) {
    try {
      const { product_id = null, restaurant_id = null } = { ...payload }
      let result = await api.post(CartRoutes.ADD, { product_id, restaurant_id });
      context.commit('addToCart', result.data.cart)
    } catch (error) {
      console.log('encountered error', error);
    }
  },

  async clearCart(context) {
    context.commit('clearCart');
    await api.get(CartRoutes.CLEAR);
  }

};



export default actions;
