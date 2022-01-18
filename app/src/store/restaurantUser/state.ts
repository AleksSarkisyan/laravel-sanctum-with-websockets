import { RestaurantUserModel } from "@/src/components/models";

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
