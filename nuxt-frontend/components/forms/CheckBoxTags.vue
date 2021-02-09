<template>
  <div class="tagsList rounded-lg my-5">
    <div class="px-4 py-3 d-flex wrap row">
      <v-col
        v-for="item in items"
        :key="item.value"
        cols="3"
      >
        <v-checkbox
          v-model="selected"
          multiple
          :label="item.text"
          :value="item.value"
          @change="update"
        />
      </v-col>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    items: {
      type: Array,
      default: () => [],
    },
    value: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      selected: [],
    }
  },
  mounted() {
    this.$nextTick(function () {
      this.selected = this.value
    })
  },
  methods: {
    update(e) {
      this.$emit('input', e)
    },
  },
}
</script>

<style></style>