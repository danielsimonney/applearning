<template>
  <v-col
    cols="3"
  >
    <v-btn
      class="mb-3 mt-3"
      x-large
      color="success"
      dark
    >
      Extra large Button
    </v-btn>
    <v-card
      color="#FFFFFF"
      class="mx-auto mt-10 mb-10 "
      outlined
      elevation="1"
    >
      <v-list rounded>
        <v-subheader>Top users</v-subheader>
     
        <v-list-item
          v-for="(item, i) in items"
          :key="i"
          class="d-flex justify-space-between flex-row align-center"
        >
          <span><v-avatar
            color="indigo"
            size="25"
          >
            <span class="white--text headline">DS</span>
          </v-avatar><span class="ml-2">{{ item.username }}</span></span>
          <span> {{ item.likes }} k</span>
          <!-- <v-list-item-content class="blue--text">
            
            <v-list-item-title v-text="item.username" />
          </v-list-item-content>
          <v-list-item-action>
           
          </v-list-item-action> -->
        </v-list-item>
      </v-list>
    </v-card>
  </v-col>
</template>

<script>
export default {
data: () => ({
      selectedItem: 1,
      items: [
        { username: 'Rajan N', likes: '15.5' },
        { username: 'Adrien P', likes: '14' },
        { username: 'Jeremei S', likes: '10' },
        { username: 'Lisan P', likes: '9.8' },
        { username: 'Maori Z', likes: '5.6' },
      ],
    }),
}
</script>

<style>

</style>