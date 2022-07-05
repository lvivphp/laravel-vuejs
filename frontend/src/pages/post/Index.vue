<template>
  <div>
    <h3 class="float-start">Post</h3>

    <p class="float-end">
      <router-link :to="{ name: 'PostAdd' }" class="btn btn-success">Add</router-link>
    </p>

    <table class="table table-hover" style="width: 100%; clear: both;">
      <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Image</th>
        <th scope="col">Title</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
      </tr>
      </thead>
      <tbody>

      <tr v-for="(post, index) in posts" :key="'row_'+index">
        <th scope="row">{{ index + 1 }}</th>
        <td><img :src="url+'/uploads/bootstrap-logo.svg'" style="height: 50px;"></td>
        <td>{{ post.title }}</td>
        <td>{{ post.status }}</td>
        <td class="action">
          <router-link :to="{ name: 'PostView', params: { id: post.id } }" class="btn btn-link">
            <i class="bi bi-eye text-primary"></i>
          </router-link>
          <router-link :to="{ name: 'PostEdit', params: { id: post.id } }" class="btn btn-link">
            <i class="bi bi-pencil text-warning"></i>
          </router-link>
          <router-link :to="{ name: 'PostDelete', params: { id: post.id } }" class="btn btn-link">
            <i class="bi bi-x text-danger"></i>
          </router-link>
        </td>
      </tr>

      <tr v-show="posts.length==0">
        <td colspan="5" class="text-center">You do not have any post</td>
      </tr>

      </tbody>
    </table>
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
  name: 'PostIndex',
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
      this.$http.get('/post')
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
