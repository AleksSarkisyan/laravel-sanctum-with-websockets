import { Module } from 'vuex';
import { StateInterface } from '../index';
import state from './state';
import { RestaurantUserModel } from '@/src/components/models';
import actions from './actions';
import getters from './getters';
import mutations from './mutations';

const restaurantUserModule: Module<RestaurantUserModel, StateInterface> = {
  namespaced: true,
  actions,
  getters,
  mutations,
  state
};

export default restaurantUserModule;
