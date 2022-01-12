import { MutationTree } from 'vuex';
import { MenusModel } from '@/src/components/models';

const mutation: MutationTree<MenusModel> = {
  setMenus ( state: MenusModel, data ) {
    return state.menus = data;
  },
};

export default mutation;
