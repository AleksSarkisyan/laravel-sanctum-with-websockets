import { GetterTree } from 'vuex';
import { StateInterface } from '../index';
import { UserModel } from '@/src/components/models';

const getters: GetterTree<UserModel, StateInterface> = {
  getUser (context) {
    return context.user
  }
};

export default getters;
