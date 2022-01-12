import { MutationTree } from 'vuex';
import { MenusModel } from '@/src/components/models';

const mutation: MutationTree<MenusModel> = {
  setMenus ( state: MenusModel, data ) {
    console.log('the data', data)
    return state.menus = data;
  },
};

export default mutation;
