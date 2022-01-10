import { ActionTree } from 'vuex';
import { StateInterface } from '../index';
import { RestaurantUserModel, API_PATHS } from '../../components/models';
import axios from 'axios';

let url = 'http://127.0.0.1:8000/';
const actions: ActionTree<RestaurantUserModel, StateInterface> = {

  async getUser (context, payload) {
    try {
      let result = await axios.post(url+API_PATHS.RESTAURANT_USER_LOGIN, payload);
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
