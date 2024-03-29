import { Module } from 'vuex';
import { StateInterface } from '../index';
import state from './state';
import { AxiosModel } from "@/src/models/Shared";
import actions from './actions';
import getters from './getters';
import mutations from './mutations';

const axiosModule: Module<AxiosModel, StateInterface> = {
  namespaced: true,
  actions,
  getters,
  mutations,
  state
};

export default axiosModule;
