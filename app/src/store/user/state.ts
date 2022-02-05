import { UserModel } from '@/src/models/User';

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
