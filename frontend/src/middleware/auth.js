export default function auth ({ next, store }) {
  if (!store.state.loggedIn) {
    return next({
      name: 'AuthLogin'
    })
  }
  return next()
}
