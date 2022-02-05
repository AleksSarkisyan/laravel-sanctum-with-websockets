import { UserModel } from "./User"

export type OrderModel = {
  id: number | string;
  restaurant_id: number;
  status: string;
  total_price: string;
  total_quantity: number;
  user: UserModel;
  user_id: number;
}

export type OrderData = {
  data: OrderModel;
}

export type Orders = {
  orders: OrderModel;
}

export type OrderConfirmed = {
  confirmed: boolean;
  restaurantName: string;
}
