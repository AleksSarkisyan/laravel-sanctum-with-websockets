import { ActionTree } from 'vuex';
import { StateInterface } from '../index';
import { API_PATHS } from '../../models/ApiPaths';
import { CartModel } from "@/src/models/Cart";
import axios from 'axios';

let url = 'http://127.0.0.1:8000/';
const actions: ActionTree<CartModel, StateInterface> = {

  updateCart (context, payload) {
    try {
      context.commit('updateCart', payload)
    } catch (error) {
      console.log('encountered error', error);
    }
  },

  updateCartProduct (context, payload) {
    try {
      context.commit('updateCartProduct', payload)
    } catch (error) {
      console.log('encountered error', error);
    }
  },


  clearCart(context) {
    context.commit('clearCart')
  }

};



export default actions;
