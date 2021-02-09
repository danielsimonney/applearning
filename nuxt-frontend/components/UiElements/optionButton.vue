<template>
  <v-tooltip bottom>
    <template #activator="{ on, attrs }">
      <div
        v-bind="attrs"
        v-on="on"
      >
        <v-btn
          text
          v-bind="$attrs"
          @click="$emit('click', $event)"
        >
          <v-icon>
            {{ name }}
          </v-icon>
        </v-btn>
      </div>
    </template>
    <span>{{ text }}</span>
  </v-tooltip>
</template>

<script>
export default {
  props: {
    name: {
      type: String,
      default: null,
    },
    text: {
      type: String,
      default: null,
    },
  },
  data() {
    return {}
  },
  computed: {},
  mounted() {},
}
</script>
<style scoped>
.btn-basic {
}
</style>