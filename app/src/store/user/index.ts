import { Module } from 'vuex';
import { StateInterface } from '../index';
import state from './state';
import { UserType, UserModel } from '@/src/components/models';
import actions from './actions';
import getters from './getters';
import mutations from './mutations';

const userModule: Module<UserModel, StateInterface> = {
  namespaced: true,
  actions,
  getters,
  mutations,
  state
};

export default userModule;