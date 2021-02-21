<template>
  <v-row>
    <v-col cols="8">
      <v-text-field
        v-model="search"
        solo-inverted
        flat
        hide-details
        placeholder="search for topics"
        prepend-inner-icon="mdi-magnify"
        single-line
        @input="filterByName"
      />
      <v-btn
        class="mb-3 mt-3"
        color="blue"
        dark
        @click="sortByDate"
      >
        {{ (ascDate) ? "Sort by Descendant date" : "Sort by Ascendant date" }}
      </v-btn>
      <card
        v-for="(topic,index) in topics"
        :key="index"
        class="mt-3 mb-3"
        :topic="topic"
      />
      <div class="text-center">
        <v-pagination
          v-model="page"
          :length="pageNumber"
          prev-icon="mdi-menu-left"
          next-icon="mdi-menu-right"
        />
      </div>
    </v-col>
    <v-col cols="4">
      <about />
    </v-col>
  </v-row>
</template>

<script>
import About from '~/components/homepage/About'
import Card from '~/components/topics/Card'

export default {
  components: { About, Card },
  layout: 'default',
  async asyncData({ $axios }) {
    try {
      let { data, meta } = await $axios.$get('/topics/search/desc')

      console.log(data)
      return {
        pageNumber: meta.last_page,
        topics: data,
        meta,
      }
    } catch (err) {
      console.log(err)
    }
  },
  data() {
    return {
      page: 1,
      ascDate: true,
      search: '',
      meta: {},
      topics: {},
    }
  },
  computed: {
    filterDate() {
      return this.ascDate ? 'desc' : 'asc'
    },
  },
  watch: {
    async page(valuePage) {
      let { data } = await this.$axios.$get(
        `/topics/search/${this.filterDate}/${this.search}/?page=${valuePage}`
      )
      this.topics = data
    },
  },
  methods: {
    async filterByName() {
      let { data } = await this.$axios.$get(`/topics/search/${this.filterDate}/${this.search}`)
      this.topics = data
      this.page = 1
    },
    async sortByDate() {
      this.ascDate = !this.ascDate
      console.log(this.filterDate)
      let { data } = await this.$axios.$get(`/topics/search/${this.filterDate}/${this.search}`)
      console.log(data)
      this.topics = data
      this.page = 1
    },
  },
}
</script>


<style scoped></style>
