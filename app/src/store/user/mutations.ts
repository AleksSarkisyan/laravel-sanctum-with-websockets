import { MutationTree } from 'vuex';
import { UserModel } from '@/src/components/models';

const mutation: MutationTree<UserModel> = {
  setUser ( state: UserModel, data ) {
    return state.user = data;
  },

};

export default mutation;
