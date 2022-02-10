import { ActionTree } from 'vuex';
import { StateInterface } from '../index';
import { API_PATHS } from '../../models/ApiPaths';
import { RestaurantUserModel } from '@/src/models/User';
import { api } from '../../boot/axios';

const actions: ActionTree<RestaurantUserModel, StateInterface> = {

  async getUser (context, payload) {
    try {
      let result = await api.post(API_PATHS.RESTAURANT_USER_LOGIN, payload);
      context.commit('setUser', result.data.data)
    } catch (error) {
      console.log('encountered error', error);
    }
  },

  resetUser (context) {
    try {
      context.commit('resetUser', null)
    } catch (error) {
      console.log('encountered error', error);
    }
  },

};



export default actions;
