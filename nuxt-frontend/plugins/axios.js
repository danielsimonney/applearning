export default context => {
  const { $axios, store } = context

  $axios.onRequest(config => {
    if (process.server) {
      config.url = process.env.API_PREFIX + config.url
    }
  })
  // On error
  $axios.onError(err => {
    // error has response
    if (err.response) {
      handleResponse(err, context)
    }

    return Promise.reject(err)
  })

  // On request
  $axios.onRequest(() => {
    store.dispatch('validation/clearErrors')
  })
}

const handleResponse = async ({ response }, context) => {
  //
  const { store, error, redirect } = context
  //
  if (!response) return

  // handle 422
  if (response.status === 422) {
    store.dispatch('validation/setErrors', response.data.errors)
    return
  }

  // handle 503::: BUG
  if (response.status === 503) {
    await store.dispatch('setConfig', { maintenance: true })
    redirect('/maintenance')
    return
  }

  // handle 401
  if (response.status === 401) {
    // logout(context)
  }

  // // handle 403
  // if (response.status === 403) {
  //   error({ statusCode: 403 })
  // }

  // handle 404
  if (response.status === 404) {
    error({ statusCode: 404 })
  }

  // handle 500
  if (parseInt(response.status) >= 500) {
    error({ statusCode: response.status })
  }
}

// const logout = async ({ app, store }) => {
//   app.$start()
//   await app.$auth.logout()
//   app.$finish()
//   store.dispatch('profile/clearDetails')
// }
