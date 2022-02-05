import { Module } from 'vuex';
import { StateInterface } from '../index';
import state from './state';
import { CartModel } from "@/src/models/Cart";
import actions from './actions';
import getters from './getters';
import mutations from './mutations';

const cartModule: Module<CartModel, StateInterface> = {
  namespaced: true,
  actions,
  getters,
  mutations,
  state
};

export default cartModule;
