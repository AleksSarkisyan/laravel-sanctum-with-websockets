import { GetterTree } from 'vuex';
import { StateInterface } from '../index';
import { AxiosModel } from '@/src/components/models';

const getters: GetterTree<AxiosModel, StateInterface> = {
  getAxiosErrors (context) {
    return context.error
  }
};

export default getters;
