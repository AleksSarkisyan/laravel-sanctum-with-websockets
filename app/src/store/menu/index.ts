import { Module } from 'vuex';
import { StateInterface } from '../index';
import state from './state';
import { MenusModel } from '@/src/components/models';
import actions from './actions';
import getters from './getters';
import mutations from './mutations';

const menusModule: Module<MenusModel, StateInterface> = {
  namespaced: true,
  actions,
  getters,
  mutations,
  state
};

export default menusModule;
