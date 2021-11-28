import { ActionTree } from 'vuex';
import { StateInterface } from '../index';
import { AxiosModel } from '../../components/models';

const actions: ActionTree<AxiosModel, StateInterface> = {
  setErrors (context, data) {
    context.commit('setErrors', data)
  },
  clearErrors(context) {
    context.commit('clearErrors')
  }

};

export default actions;
