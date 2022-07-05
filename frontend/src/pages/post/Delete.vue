<script>
export default {
  name: 'PostDelete',
  created() {
    this.fetchData()
  },
  watch: {
    '$route': 'fetchData'
  },
  methods: {
    fetchData() {
      this.$http.delete('/post/'+this.$route.params.id)
          .then(() => {
            this.$router.push('/')
          })
          .catch((err) => {
            console.log(err)
          })
    }
  }
}
</script>
