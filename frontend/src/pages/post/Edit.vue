<template>
  <div>
    <h2>Edit post</h2>
    <form @submit.prevent>
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" v-model="post.title">
      </div>

      <div class="form-group">
        <label for="text">Text</label>
        <textarea class="form-control" id="text" v-model="post.text"></textarea>
      </div>

      <div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" id="status" v-model="post.status">
          <option value="0">hide</option>
          <option value="1">show</option>
        </select>
      </div>

      <div class="form-group">
        <div class="input-group">
          <div class="custom-file">
            <input type="hidden" v-model="post.image">
            <input type="file" class="custom-file-input" id="image" ref="image" v-on:change="handleFileUpload()">
            <label class="custom-file-label" for="image">Choose file</label>
          </div>
        </div>
      </div>

      <p>
        <button type="submit" class="btn btn-primary" v-on:click="editItem($event)">Submit</button>
        <router-link :to="{ name: 'PostIndex' }" class="btn btn-danger">Cancel</router-link>
      </p>
    </form>
  </div>
</template>

<script>
export default {
  name: 'PostEdit',
  data() {
    return {
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
      this.$http.get('/post/'+this.$route.params.id)
          .then((response) => {
            this.post = response.data
          })
          .catch((err) => {
            console.log(err)
          })
    },
    editItem(event) {
      if (event) event.preventDefault();

      this.$http.patch('/post/'+this.$route.params.id, {
        title: this.post.title,
        text: this.post.text,
        status: this.post.status,
        image: this.post.image,
      }).then(() => {
        this.$router.push('/')
      }).catch((error) => {
        console.log(error);
      })
    },
    handleFileUpload(){
      this.post.image = this.$refs.image.files[0];
    }
  }
}
</script>
