<template>
  <!-- <v-card
    class="cardBase mb-15 pr-10 pl-10"
    color="#FAFAFA"
  > -->
  <div>
    <card-show :topic="meta.topic" />
    <post
      v-for="(post,index) in posts"
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
import FormPost from '../../../components/posts/FormPost.vue'
import Post from '../../../components/posts/Post.vue'
import BaseButton from '../../../components/UiElements/BaseButton.vue'
export default {
  components: { Post, BaseButton, FormPost, CardShow },
  async asyncData({ params, $axios }) {
    try {
      const { data, meta } = await $axios.$get(`/topics/${params.topic}/posts`)
      console.log(meta, 'its meta')
      return {
        meta: meta,
        posts: data,
      }
    } catch (err) {
      console.log(err)
    }
  },
  data() {
    return {
      show: false,
      posts: [],
      meta: null,
      body: '',
    }
  },
  computed: {
    topic() {
      return this.meta?.topic
    },
  },
  mounted() {
    console.log(this.topic)
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