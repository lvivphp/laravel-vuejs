<template>
  <div>
    <div>
      <h3 class="float-start">{{ post.title }}</h3>
      <p class="float-end">
        <span class="text-muted">author: {{ post.user.name }}</span>,
        <span class="text-muted">date: {{ post.created_at | formatDate }}</span>
      </p>
    </div>

    <div class="row" style="clear: both;">
      <div class="col-md-3">
        <img :src="url+'/uploads/bootstrap-logo.svg'" style="height: 100px;">
      </div>
      <div class="col-md-9">
        {{ post.text }}
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
      post: { user : {} },
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
      axios.get('/default/view/'+this.$route.params.id)
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
