<template>
  <div class="container col-md-6 mt-5">
    <h3>Create a new topic</h3>
    <br>
    <form @submit.prevent="create">
      <div class="form-group">
        <label><strong>Topic title:</strong></label>
        <input
          v-model.trim="form.title"
          type="text"
          class="form-control"
          placeholder="Enter topic title"
          autofocus
        >
      </div>
      <div class="form-group">
        <label><strong>Topic body:</strong></label>
        <textarea
          v-model="form.body"
          rows="10"
          class="form-control"
        />
        <small
          v-if="errors.body"
          class="form-text text-danger"
        >{{ errors.body[0] }}</small>
      </div>
      <div
        class="btn-group"
        role="group"
        aria-label="Basic checkbox toggle button group"
      >
        <span
          v-for="(content,index) in tags"
          :key="index"
        >
          <input
            :id="content.id"
            v-model="form.tags"
            type="checkbox"
            :value="content.id"
            class="btn-check"
            autocomplete="off"
          >
          <label
            class="btn btn-outline-primary"
            :for="content.id"
          >{{ content.name }}</label>
        </span>
      </div>
      <button
        type="submit"
        class="btn btn-primary"
      >
        Create
      </button>
    </form>
  </div>
</template>

<script>
export default {
      async asyncData({$axios}) {
        console.log("hi")
      try{
          let {data} = await $axios.$get('/tags')
          console.log(data)
          return{
            tags:data,
          }
          }catch(err) {
        console.log(err)
          }
    },
      data(){
        return{
          form:{
            title:'',
            body:'',
            tags:[],
          },
          tags:[],
          // tagsChecked:[],
        }
      },
      methods:{
        async create(){
          console.log(this.form)
          try{
            await this.$axios.$post('/topics',this.form)
          this.$router.push('/')
          }catch(err) {
        console.log(err)
          }
        },
      },
    }
</script>

<style>

</style>