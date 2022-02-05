import { MutationTree } from 'vuex';
import { UserModel } from '@/src/models/User';

const mutation: MutationTree<UserModel> = {
  setUser ( state: UserModel, data ) {
    return state.user = data;
  },

  resetUser ( state: UserModel, data ) {
    state.user = state.initialUserState;

    return state.user;
  },

};

export default mutation;
