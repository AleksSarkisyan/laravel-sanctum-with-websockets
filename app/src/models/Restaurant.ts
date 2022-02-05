import { AvailableMenusProps, SelectedMenuProps } from '../models/Menu';


export interface EditRestaurantComponentData {
  selectedMenu: number | SelectedMenuProps;
  availableMenus: AvailableMenusProps[];
  restaurant: Restaurant;
}

export type Restaurant = {
  data: {
    restaurant: {
      id: number;
      user_id: number;
      menu_id: number;
      name: string;
      city: string;
    }
  }
}

export type RestaurantModel = {
  city: string;
  id: number;
  menu_id: number;
  name: string;
}

export interface RestaurantsModel {
  restaurants: RestaurantModel[] | null
}

export type RestaurantRegistrationModel = {
  email: string;
  password: string;
  restaurantName: string;
  name: string;
  city: string;
}
