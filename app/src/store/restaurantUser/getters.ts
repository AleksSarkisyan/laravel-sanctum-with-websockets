import { GetterTree } from 'vuex';
import { StateInterface } from '../index';
import { RestaurantUserModel } from '@/src/components/models';

const getters: GetterTree<RestaurantUserModel, StateInterface> = {
  getUser (context) {
    return { ...context.user };
  }
};

export default getters;
