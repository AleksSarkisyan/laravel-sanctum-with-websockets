import { GetterTree } from 'vuex';
import { StateInterface } from '../index';
import { MenusModel } from '@/src/components/models';

const getters: GetterTree<MenusModel, StateInterface> = {
  getAllById (context) {
    return context.menus
  }
};

export default getters;
