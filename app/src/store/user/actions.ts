import { ActionTree } from 'vuex';
import { StateInterface } from '../index';
import { UserModel, API_PATHS } from '../../components/models';
import axios from 'axios';

let url = 'http://127.0.0.1:8000/';
const actions: ActionTree<UserModel, StateInterface> = {

  async getUser (context) {
    try {
      let result = await axios.get(url+API_PATHS.USER);
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
