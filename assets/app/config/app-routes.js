const appRoutes = [
  {
    path: "/private",
    name: "home",
    component: require('../pages/Home/index.vue').default
  },
  {
    path: "/private/about",
    name: "about",
    component: require('../pages/About/index.vue').default
  }
]
export default appRoutes