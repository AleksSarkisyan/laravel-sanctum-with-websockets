import { AxiosModel } from "@/src/components/models";

function state(): AxiosModel {
  return {
    error: {
      errors: [],
      message: '',
    },

  }
};

export default state;
