import { ActionTree } from 'vuex';
import { StateInterface } from '../index';
import { UserModel } from '@/src/models/User';
import { API_PATHS } from '../../models/ApiPaths';
import { api } from '../../boot/axios';

const actions: ActionTree<UserModel, StateInterface> = {

  async getUser (context) {
    try {
      let result = await api.get(API_PATHS.USER);
      context.commit('setUser', result.data)
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
