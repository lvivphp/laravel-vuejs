<template>
  <main class="form-signin w-100 m-auto text-center">
    <form>
      <img class="mb-4" src="/bootstrap-logo.svg" alt="" width="72" height="57">
      <h1 class="h3 mb-3 fw-normal">Please sign up</h1>
      <div class="form-floating">
        <input type="text" class="form-control" id="name" placeholder="myname">
        <label for="name">Name</label>
      </div>
      <div class="form-floating">
        <input type="email" class="form-control" id="email" placeholder="name@example.com">
        <label for="email">Email address</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="password" placeholder="Password">
        <label for="password">Password</label>
      </div>
      <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
    </form>
  </main>
</template>

<style>
html,
body {
  height: 100%;
}

body {
  align-items: center;
  background-color: #f5f5f5;
}

.form-signin {
  max-width: 330px;
  padding: 15px;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>

<script>
import axios from 'axios'
export default {
  name: 'DefaultIndex',
  data() {
    return {
      products: {}
    }
  },
  created() {
    this.fetchData()
  },
  watch: {
    '$route': 'fetchData'
  },
  methods: {
    fetchData() {
      axios.get('/api/product/')
          .then((response) => {
            this.products = response.data
          })
          .catch((err) => {
            console.log(err)
          })
    }
  }
}
</script>
