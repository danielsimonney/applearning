<template>
  <!-- <v-card
    class="cardBase mb-15 pr-10 pl-10"
    color="#FAFAFA"
  > -->
  <div>
    <card-show :topic="topic" />
    <post
      v-for="(post,index) in topic.posts"
      :key="index"
      class="mt-3 mb-3"
      :is-better="index"
      :post="post"
    />
    <div class="justify-center d-flex">
      <base-button
        v-show="!show"
        text="Répondre au topic"
        @click="show = !show"
      />
    </div>
    
    <v-expand-transition>
      <div v-show="show">
        <form-post @close="show = !show" />
      </div>
    </v-expand-transition>
  </div>
</template>

<script>
import CardShow from '../../../components/topics/CardShow.vue'
import FormPost from '../../../components/topics/FormPost.vue'
import Post from '../../../components/topics/Post.vue'
import BaseButton from '../../../components/UiElements/BaseButton.vue'
export default {
  components: { CardShow, Post, BaseButton, FormPost },
  async asyncData({ params, $axios }) {
    try {
      const { data } = await $axios.$get(`/topics/${params.id}`)
      console.log(data)
      return {
        topic: data,
      }
    } catch (err) {
      console.log(err)
    }
  },
  data() {
    return {
      show: false,
      topic: '',
      body: '',
    }
  },
}
</script>

<style>
.content {
  margin-left: 30px;
  border-left: 15px solid white;
  padding: 0 10px 0 30px;
}

.btn-outline-success,
.btn-outline-danger {
  border: none;
}
</style>