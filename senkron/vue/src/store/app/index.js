import { $themeBreakpoints } from '@themeConfig'

export default {
  namespaced: true,
  state: {
    fullLoading: false,
    elementLoading: false,
    windowWidth: 0,
    shallShowOverlay: false,
  },
  getters: {
    fullLoading: state => state.fullLoading,
    elementLoading: state => state.elementLoading,
    currentBreakPoint: state => {
      const { windowWidth } = state
      if (windowWidth >= $themeBreakpoints.xl) return 'xl'
      if (windowWidth >= $themeBreakpoints.lg) return 'lg'
      if (windowWidth >= $themeBreakpoints.md) return 'md'
      if (windowWidth >= $themeBreakpoints.sm) return 'sm'
      return 'xs'
    },
  },
  mutations: {
    FULL_LOADING(state, val) { state.fullLoading = val },
    ELEMENT_LOADING(state, val) { state.elementLoading = val },
    UPDATE_WINDOW_WIDTH(state, val) {
      state.windowWidth = val
    },
    TOGGLE_OVERLAY(state, val) {
      state.shallShowOverlay = val !== undefined ? val : !state.shallShowOverlay
    },
  },
  actions: {
    elementLoading({ commit }, payload) {
      commit('ELEMENT_LOADING', payload)
    },
    fullLoading({ commit }, payload) {
      const appLoading = document.getElementById('loading-bg')
      if (appLoading) {
        if (payload) {
          // appLoading.style.display = 'block'
          appLoading.classList.add('loading-show')
          appLoading.classList.remove('loading-hidden')
        } else {
          appLoading.classList.add('loading-hidden')
          appLoading.classList.remove('loading-show')
        }
      }
      commit('FULL_LOADING', payload)
    },
  },
  mixins: {
    getters: {
      MixinElementLoading: state => state.elementLoading,
    },
  },
}
