<template>
  <div class="tagsList rounded-lg my-5">
    <div class="px-4 py-3 d-flex wrap row">
      <base-checkbox
        v-for="(tag,index) in tags.existant"
        :key="index"
        :label="tag.name"
        input-value="true"
        @input="$emit('input', $event)"
      />
    </div>
  </div>
</template>

<script>
import baseCheckbox from '../UiElements/baseCheckbox.vue'
export default {
  components: { baseCheckbox },
  props: {
    tags: {
      type: Object,
      default: null,
    },
  },
  mounted() {
    console.log(this.tagsArray)
  },
  methods: {
    toggleCheckbox(state, id) {
      console.log(state, id)
    },
  },
}
</script>

<style></style>