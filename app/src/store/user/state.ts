import { UserModel } from "@/src/components/models";

function state(): UserModel {
  return {
    user: {
      id: null,
      name: '',
      email: '',
    },
    initialUserState: {
      id: null,
      name: '',
      email: '',
    }

  }
};

export default state;
