import { MutationTree } from 'vuex';
import { CartModel, ProductItemsModel } from '@/src/components/models';

const mutation: MutationTree<CartModel> = {
  updateCart ( state: CartModel, data ) {

    let addedProduct = null as ProductItemsModel | null;

    /** Check if we already have the product */
    state.productItems.find(({...item}) => {
      if( item.id == data.id) {
        addedProduct = item
      }
    })

    /** Add it */
    if (!addedProduct) {
      state.productItems.push({
        id: data.id,
        quantity: 1,
        summedPrice: data.price,
        singlePrice: Number(data.price)
      });
      state.products.push({ data })
    } else {
      /** Product already added, just increatse its quantity */
      for (const [index, value] of state.productItems.entries()) {

        if(value.id == data.id) {
          state.productItems[index].quantity = state.productItems[index].quantity + 1;
          state.productItems[index].summedPrice = state.productItems[index].quantity * data.price;
        }
      }

    }

    return state = {
      products: state.products,
      productItems: state.productItems,
      totalCartPrice: state.totalCartPrice,
      totalCartQuantity: state.totalCartQuantity
    }

  },

  updateCartProduct(state: CartModel, data) {
    let initialProductsState = state.products;

    for (const [_, product] of initialProductsState.entries()) {
      if(product.data.id == data.id) {
        product.data.quantity = data.quantity;
        product.data.summedPrice = data.summedPrice;
        state.totalCartPrice = Number(state.totalCartPrice) +  Number(product.data.price);
      }
    }

    state.totalCartQuantity  = state.productItems.reduce((acc, item) => {
      return acc += item.quantity;
    }, 0);

    state.products = initialProductsState;

    return state;
  },

  clearCart(state:CartModel) {
    state.productItems = [];
    state.products = [];
    state.totalCartPrice = 0;
    state.totalCartQuantity = 0;
  }
};

export default mutation;
