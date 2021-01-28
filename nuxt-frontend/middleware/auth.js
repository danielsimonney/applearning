export default ({ app, redirect }) => {
  const redirectTo = `/auth`
  if (!app.$auth.loggedIn) {
    return redirect(redirectTo)
  }
}
