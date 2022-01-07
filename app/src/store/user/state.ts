import { UserModel } from "@/src/components/models";

function state(): UserModel {
  return {
    user: {
      name: '',
      email: '',
    },
    initialUserState: {
      name: '',
      email: '',
    }

  }
};

export default state;
