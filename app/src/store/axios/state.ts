import { AxiosModel } from "@/src/models/Shared";

function state(): AxiosModel {
  return {
    error: {
      errors: [],
      message: '',
    },

  }
};

export default state;
