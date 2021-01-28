import { omit, mapKeys } from 'lodash'

export const state = () => ({
  errors: {},
})

export const getters = {
  errors(state) {
    return mapKeys(state.errors, (value, key) => key.split('.').shift())
  },
}

export const actions = {
  setErrors({ commit }, errors) {
    commit('SET_VALIDATION_ERRORS', errors)
  },
  clearErrors({ commit }) {
    commit('SET_VALIDATION_ERRORS', {})
  },
  clearError({ commit }, error) {
    commit('SET_VALIDATION_ERROR', error)
  },
}

export const mutations = {
  SET_VALIDATION_ERRORS(state, errors) {
    state.errors = errors
  },
  SET_VALIDATION_ERROR(state, error) {
    state.errors = omit(state.errors, [error])
  },
}
