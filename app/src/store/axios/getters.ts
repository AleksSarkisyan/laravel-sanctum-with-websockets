import { GetterTree } from 'vuex';
import { StateInterface } from '../index';
import { AxiosModel } from "@/src/models/Shared";

const getters: GetterTree<AxiosModel, StateInterface> = {
  getAxiosErrors (context) {
    return context.error
  }
};

export default getters;
