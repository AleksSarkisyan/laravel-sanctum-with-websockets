import { RestaurantUserModel } from "@/src/components/models";

function state(): RestaurantUserModel {
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
