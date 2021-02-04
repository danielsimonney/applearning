<template>
  <div>
    <card
      v-for="(topic,index) in topics"
      :key="index"
      class="mt-3 mb-3"
      :topic="topic"
    />
  </div>
</template>

<script>
import Card from '../components/topics/Card'

export default {
  components: {
    Card,
  },
  layout: 'default',
  async asyncData({ $axios }) {
    try {
      let { data, links } = await $axios.$get('/topics')
      console.log(data)
      return {
        topics: data,
        links,
      }
    } catch (err) {
      console.log(err)
    }
  },
}
</script>


<style scoped></style>
