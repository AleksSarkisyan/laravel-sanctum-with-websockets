import { UserType, UserModel } from "@/src/components/models";

function state(): UserModel {
  return {
    user: {
      name: '',
      email: '',
    },

  }
};

export default state;
