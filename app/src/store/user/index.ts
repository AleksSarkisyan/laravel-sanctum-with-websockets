import { Module } from 'vuex';
import { StateInterface } from '../index';
import state from './state';
import { UserModel } from '@/src/models/User';
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
