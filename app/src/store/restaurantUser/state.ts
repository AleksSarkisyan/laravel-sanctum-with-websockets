import { RestaurantUserModel } from '@/src/models/User';

function state(): RestaurantUserModel {
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
