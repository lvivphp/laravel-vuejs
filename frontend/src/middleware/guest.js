export default function guest ({ next, store }) {
  if (store.state.loggedIn) {
    return next({
      name: 'PostIndex'
    })
  }

  return next()
}
