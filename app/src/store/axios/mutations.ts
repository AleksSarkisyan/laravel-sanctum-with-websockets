import { MutationTree } from 'vuex';
import { AxiosModel } from "@/src/models/Shared";

const mutation: MutationTree<AxiosModel> = {
  setErrors ( state: AxiosModel, data ) {
    return state.error = data;
  },

  clearErrors ( state: AxiosModel, data ) {
    return state.error = {
      errors: [],
      message: ''
    }
  },

};

export default mutation;
