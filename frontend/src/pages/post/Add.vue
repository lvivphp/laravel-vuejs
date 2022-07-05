<template>
  <div>
    <div>
      <h2 class="float-start">Create post</h2>

      <p class="float-end">
        <router-link :to="{ name: 'PostIndex' }" class="btn btn-primary">List</router-link>
      </p>
    </div>

    <form @submit.prevent style="clear: both;">
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
            <input type="file" class="custom-file-input" id="image" ref="image" v-on:change="handleFileUpload()">
            <label class="custom-file-label" for="image">Choose file</label>
          </div>
        </div>
      </div>

      <p class="text-right">
        <button type="submit" class="btn btn-primary" v-on:click="addItem($event)">Submit</button>
        <router-link :to="{ name: 'Index' }" class="btn btn-danger">Cancel</router-link>
      </p>
    </form>
  </div>
</template>

<script>
export default {
  name: 'PostAdd',
  data() {
    return {
      post: {
        title: '',
        text: '',
        status: 1,
        image: null
      },
    }
  },
  methods: {
    addItem(event) {
      if (event) event.preventDefault();
      let form = new FormData();
      form.append('title', this.post.title);
      form.append('text', this.post.text);
      form.append('status', this.post.status);
      form.append('image', this.post.image);

      this.$http.post('/post', form, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }).then(() => {
        this.$router.push('/post')
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
