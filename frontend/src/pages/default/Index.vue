<template>
  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div v-for="(post, index) in posts" :key="'row_'+index" class="col">
          <div class="card shadow-sm">
            <img :src="url+'/uploads/bootstrap-logo.svg'" width="auto" height="225">
            <div class="card-body">
              <p class="card-text">{{ post.title }}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <router-link :to="{ name: 'DefaultView', params: { id: post.id } }" class="btn btn-sm btn-outline-secondary">
                    View
                  </router-link>
                </div>
                <small class="text-muted">author: {{ post.user.name }}</small>
                <small class="text-muted">date: {{ post.created_at | formatDate }}</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style>
.action .btn-link i {
  font-size: 18px;
  font-weight: bolder;
}
</style>
<script>
export default {
  name: 'DefaultIndex',
  data() {
    return {
      url: process.env.VUE_APP_PUBLIC_URL,
      posts: {}
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
      this.$http.get('/default')
          .then((response) => {
            this.posts = response.data
          })
          .catch((err) => {
            console.log(err)
          })
    }
  }
}
</script>
