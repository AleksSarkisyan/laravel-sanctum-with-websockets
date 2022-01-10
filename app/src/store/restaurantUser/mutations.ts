import { MutationTree } from 'vuex';
import { RestaurantUserModel } from '@/src/components/models';

const mutation: MutationTree<RestaurantUserModel> = {
  setUser ( state: RestaurantUserModel, data ) {
    return state.user = data;
  },

  resetUser ( state: RestaurantUserModel, data ) {
    state.user = state.initialUserState;

    return state.user;
  },

};

export default mutation;
