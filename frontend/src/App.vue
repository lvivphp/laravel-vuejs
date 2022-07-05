<template>
  <div id="app">
    <main>
      <header class="py-3 mb-3 border-bottom">
        <div class="container">
          <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
              <img class="bi me-2" src="/bootstrap-logo.svg" alt="" width="40" height="32">
            </a>
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
              <li><router-link :to="{ name: 'DefaultIndex' }" class="nav-link px-2 link-dark">Posts</router-link></li>
            </ul>
            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
              <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
            </form>
            <div class="dropdown text-end" v-if="$store.state.loggedIn">
              <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle"
                 v-on:mouseover="mouseover"
                 v-on:mouseleave="mouseleave">
                {{ $store.state.user.name }}
                <ul class="dropdown-menu text-small" :style="dropdown ? 'display: block;' : ''">
                  <li><router-link :to="{ name: 'PostIndex' }" class="dropdown-item">Posts</router-link></li>
                  <li><router-link :to="{ name: 'PostAdd' }" class="dropdown-item">New post</router-link></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#" @click="logout">Sign out</a></li>
                </ul>
              </a>
            </div>
            <div class="text-end" v-else>
              <router-link :to="{ name: 'AuthLogin' }" class="btn btn-outline-primary me-2">Login</router-link>
              <router-link :to="{ name: 'AuthRegister' }" class="btn btn-warning">Sign-up</router-link>
            </div>
          </div>
        </div>
      </header>
      <div class="container">
        <router-view />
      </div>
    </main>
  </div>
</template>

<script>
export default {
  name: 'app',
  data() {
    return {
      dropdown: false,
    }
  },
  methods: {
    mouseover: function () {
      this.dropdown = true;
    },
    mouseleave: function () {
      this.dropdown = false;
    },
    logout() {
      this.$http.post('/auth/logout')
          .then(() => {
            this.$store.state.token = null
            this.$store.state.user = {}
          })
          .catch((err) => {
            console.log(err)
          })

      this.$store.state.loggedIn = false
      this.$router.push({ name: 'DefaultIndex' })
    },
  }
}
</script>

<style>
.form-control-dark {
  border-color: var(--bs-gray);
}
.form-control-dark:focus {
  border-color: #fff;
  box-shadow: 0 0 0 .25rem rgba(255, 255, 255, .25);
}

.text-small {
  font-size: 85%;
}

.dropdown-toggle {
  outline: 0;
}
</style>
