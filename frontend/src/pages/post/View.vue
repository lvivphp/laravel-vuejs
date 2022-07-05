<template>
  <div>
    <div>
      <h3 class="float-start">View post</h3>
      <p class="float-end">
        <router-link :to="{ name: 'PostIndex' }" class="btn btn-primary">List</router-link>
        <router-link :to="{ name: 'PostEdit', params: { id: post.id } }" class="btn btn-warning">Edit</router-link>
        <router-link :to="{ name: 'PostDelete', params: { id: post.id } }" class="btn btn-danger">Delete</router-link>
      </p>
    </div>

    <div class="row" style="clear: both;">
      <div class="col-md-3">
        <img :src="url+'/uploads/bootstrap-logo.svg'" style="height: 100px;">
      </div>
      <div class="col-md-9">
        <table class="table table-hover" style="width: 100%;">
          <tbody>
          <tr>
            <th scope="col">Image</th>
            <th scope="col">{{ post.image || 'bootstrap-logo.svg' }}</th>
          </tr>
          <tr>
            <th scope="col">Title</th>
            <th scope="col">{{ post.title }}</th>
          </tr>
          <tr>
            <th scope="col">Text</th>
            <th scope="col">{{ post.text }}</th>
          </tr>
          <tr>
            <th scope="col">Status</th>
            <th scope="col">{{ post.status }}</th>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios'
export default {
  name: 'PostView',
  data() {
    return {
      url: process.env.VUE_APP_PUBLIC_URL,
      post: {},
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
      axios.get('/post/'+this.$route.params.id)
          .then((response) => {
            this.post = response.data
          })
          .catch((err) => {
            console.log(err)
          })
    }
  }
}
</script>
