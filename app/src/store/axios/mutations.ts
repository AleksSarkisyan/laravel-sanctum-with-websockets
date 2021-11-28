import { MutationTree } from 'vuex';
import { AxiosModel } from '@/src/components/models';

const mutation: MutationTree<AxiosModel> = {
  setErrors ( state: AxiosModel, data ) {
    return state.error = data;
  },

  clearErrors ( state: AxiosModel, data ) {
    // state.error.errors = [];
    // state.error.message = '';
    return state.error = {
      errors: [],
      message: ''
    }
  },

};

export default mutation;
