import { ActionTree } from 'vuex';
import { StateInterface } from '../index';
import { API_PATHS } from '../../models/ApiPaths';
import { MenusModel } from "@/src/models/Menu";
import axios from 'axios';

let url = 'http://127.0.0.1:8000/';
const actions: ActionTree<MenusModel, StateInterface> = {

  async getAllById (context) {
    try {
      let result = await axios.get(url+API_PATHS.RESTAURANT_GET_USER_MENUES);
      context.commit('setMenus', result.data.data)
    } catch (error) {
      console.log('encountered error', error);
    }
  },

};



export default actions;
